<?php

namespace App\Http\Controllers;

use App\Mail\BookPurchaseMail;
use App\Models\Book;
use App\Models\BookOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Stripe\Checkout\Session;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class BookPurchaseController extends Controller
{
    public function checkout($slug)
    {
        $book = Book::where('slug', $slug)->active()->firstOrFail();

        if (! $book->file_path) {
            return redirect()->route('books.show', $book->slug)
                ->with('error', 'This book is not available for purchase yet.');
        }

        if (! config('services.stripe.key') || ! config('services.stripe.secret')) {
            return redirect()->route('books.show', $book->slug)
                ->with('error', 'Payment is not configured. Please contact the author.');
        }

        $page_title = 'Checkout | '.$book->title;

        return view('website.book-checkout', compact('book', 'page_title'));
    }

    public function paymentIntent(Request $request, $slug)
    {
        $request->validate([
            'email' => 'required|email|max:255',
            'name' => 'nullable|string|max:255',
        ]);

        $book = Book::where('slug', $slug)->active()->firstOrFail();

        if (! $book->file_path) {
            return response()->json(['error' => 'This book is not available for purchase.'], 422);
        }

        Stripe::setApiKey(config('services.stripe.secret'));

        $intent = PaymentIntent::create([
            'amount' => (int) round((float) $book->price * 100),
            'currency' => 'usd',
            'automatic_payment_methods' => ['enabled' => true],
            'metadata' => [
                'book_id' => (string) $book->id,
                'book_slug' => $book->slug,
            ],
            'receipt_email' => $request->email,
        ]);

        $order = BookOrder::where('stripe_payment_intent', $intent->id)->first();

        if (! $order) {
            $order = BookOrder::create([
                'book_id' => $book->id,
                'customer_email' => $request->email,
                'customer_name' => $request->name,
                'stripe_session_id' => $intent->id,
                'stripe_payment_intent' => $intent->id,
                'amount_paid' => $book->price,
                'currency' => 'usd',
                'status' => 'pending',
                'download_token' => Str::random(64),
            ]);
        } else {
            $order->update([
                'customer_email' => $request->email,
                'customer_name' => $request->name,
            ]);
        }

        return response()->json([
            'clientSecret' => $intent->client_secret,
            'orderToken' => $order->download_token,
        ]);
    }

    public function success(Request $request)
    {
        $paymentIntentId = $request->query('payment_intent');
        $sessionId = $request->query('session_id');

        if (! $paymentIntentId && ! $sessionId) {
            return redirect()->route('books')->with('error', 'Invalid purchase session.');
        }

        Stripe::setApiKey(config('services.stripe.secret'));

        if ($paymentIntentId) {
            return $this->successFromPaymentIntent($paymentIntentId);
        }

        return $this->successFromCheckoutSession($sessionId);
    }

    private function successFromPaymentIntent(string $paymentIntentId)
    {
        try {
            $intent = PaymentIntent::retrieve($paymentIntentId);
        } catch (\Exception $e) {
            return redirect()->route('books')->with('error', 'Could not verify payment.');
        }

        if ($intent->status !== 'succeeded') {
            return redirect()->route('books')->with('error', 'Payment was not completed.');
        }

        $order = BookOrder::where('stripe_payment_intent', $intent->id)->first();

        if (! $order) {
            $bookId = $intent->metadata->book_id ?? null;
            $book = $bookId ? Book::find($bookId) : null;

            if (! $book) {
                return redirect()->route('books')->with('error', 'Order not found.');
            }

            $order = BookOrder::create([
                'book_id' => $book->id,
                'customer_email' => $intent->receipt_email ?? 'customer@unknown.com',
                'customer_name' => null,
                'stripe_session_id' => $intent->id,
                'stripe_payment_intent' => $intent->id,
                'amount_paid' => $intent->amount / 100,
                'currency' => $intent->currency,
                'status' => 'paid',
                'download_token' => Str::random(64),
            ]);
            $this->sendPurchaseNotification($order);
        } else {
            $this->completeOrder($order, [
                'amount_paid' => $intent->amount / 100,
                'currency' => $intent->currency,
            ]);
        }

        $book = $order->book;

        return view('website.purchase-success', [
            'book' => $book,
            'order' => $order,
            'page_title' => 'Purchase Complete | '.$book->title,
        ]);
    }

    private function successFromCheckoutSession(string $sessionId)
    {
        try {
            $session = Session::retrieve($sessionId);
        } catch (\Exception $e) {
            return redirect()->route('books')->with('error', 'Could not verify payment.');
        }

        if ($session->payment_status !== 'paid') {
            return redirect()->route('books')->with('error', 'Payment was not completed.');
        }

        $order = BookOrder::where('stripe_session_id', $sessionId)->first();

        if (! $order) {
            $bookId = $session->metadata->book_id ?? null;
            $book = $bookId ? Book::find($bookId) : null;

            if (! $book) {
                return redirect()->route('books')->with('error', 'Order not found.');
            }

            $order = BookOrder::create([
                'book_id' => $book->id,
                'customer_email' => $session->customer_details->email ?? $session->customer_email ?? 'customer@unknown.com',
                'customer_name' => $session->customer_details->name ?? null,
                'stripe_session_id' => $sessionId,
                'stripe_payment_intent' => $session->payment_intent,
                'amount_paid' => $session->amount_total / 100,
                'currency' => $session->currency,
                'status' => 'paid',
                'download_token' => Str::random(64),
            ]);
            $this->sendPurchaseNotification($order);
        } else {
            $this->completeOrder($order, [
                'stripe_payment_intent' => $session->payment_intent,
                'amount_paid' => $session->amount_total / 100,
                'currency' => $session->currency,
            ]);
        }

        $book = $order->book;

        return view('website.purchase-success', [
            'book' => $book,
            'order' => $order,
            'page_title' => 'Purchase Complete | '.$book->title,
        ]);
    }

    public function download($token)
    {
        $order = BookOrder::where('download_token', $token)
            ->where('status', 'paid')
            ->firstOrFail();

        $book = $order->book;
        $filePath = $book->resolveFilePath();

        if (! $filePath) {
            Log::error('Book download file missing', [
                'book_id' => $book->id,
                'file_path' => $book->file_path,
                'order_id' => $order->id,
            ]);

            abort(404, 'Book file is missing. Please contact support.');
        }

        $order->update(['downloaded_at' => now()]);

        $downloadName = Str::slug($book->title).'.'.$book->file_type;

        return response()->download($filePath, $downloadName, [
            'Content-Type' => $book->file_type === 'epub'
                ? 'application/epub+zip'
                : 'application/pdf',
        ]);
    }

    public function legacyDownloadRedirect($token)
    {
        return redirect()->route('book.download', ['token' => $token], 301);
    }

    private function completeOrder(BookOrder $order, array $attributes = []): BookOrder
    {
        $wasAlreadyPaid = $order->isPaid();

        $order->fill(array_merge($attributes, ['status' => 'paid']));
        $order->save();
        $order->load('book');

        if (! $wasAlreadyPaid) {
            $this->sendPurchaseNotification($order);
        }

        return $order;
    }

    private function sendPurchaseNotification(BookOrder $order): void
    {
        $order->loadMissing('book');
        $adminEmail = config('mail.from.address');

        try {
            Mail::to($adminEmail)->send(new BookPurchaseMail($order));
            Log::info('Book purchase email sent to ' . $adminEmail, ['order_id' => $order->id]);
        } catch (\Exception $e) {
            Log::error('Book purchase email failed', [
                'order_id' => $order->id,
                'to' => $adminEmail,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
