<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Stripe\Checkout\Session;
use Stripe\Stripe;

class BookPurchaseController extends Controller
{
    public function checkout(string $slug)
    {
        $book = Book::active()->where('slug', $slug)->firstOrFail();

        if (! $book->file_path) {
            return redirect()->route('books.show', $book->slug)
                ->with('error', 'This book is not available for purchase yet.');
        }

        Stripe::setApiKey(config('services.stripe.secret'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'unit_amount' => (int) round($book->price * 100),
                    'product_data' => [
                        'name' => $book->title,
                        'description' => $book->subtitle,
                    ],
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('books.purchase.success').'?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('books.show', $book->slug).'?cancelled=1',
            'metadata' => [
                'book_id' => (string) $book->id,
            ],
        ]);

        BookOrder::updateOrCreate(
            ['stripe_session_id' => $session->id],
            [
                'book_id' => $book->id,
                'customer_email' => 'pending@checkout.stripe',
                'amount_paid' => $book->price,
                'currency' => 'usd',
                'status' => 'pending',
                'download_token' => Str::random(64),
            ]
        );

        return redirect($session->url);
    }

    public function success(Request $request)
    {
        $sessionId = $request->query('session_id');

        if (! $sessionId) {
            return redirect()->route('books')->with('error', 'Invalid purchase session.');
        }

        Stripe::setApiKey(config('services.stripe.secret'));
        $session = Session::retrieve($sessionId);

        if ($session->payment_status !== 'paid') {
            return redirect()->route('books')->with('error', 'Payment was not completed.');
        }

        $bookId = (int) ($session->metadata->book_id ?? 0);
        $book = Book::find($bookId);

        if (! $book) {
            return redirect()->route('books')->with('error', 'Book not found for this purchase.');
        }

        $order = BookOrder::where('stripe_session_id', $sessionId)->first();

        if (! $order) {
            $order = BookOrder::create([
                'book_id' => $book->id,
                'customer_email' => $session->customer_details->email ?? $session->customer_email ?? 'unknown@stripe.com',
                'customer_name' => $session->customer_details->name ?? null,
                'stripe_session_id' => $sessionId,
                'stripe_payment_intent' => $session->payment_intent,
                'amount_paid' => $book->price,
                'currency' => 'usd',
                'status' => 'paid',
                'download_token' => Str::random(64),
            ]);
        } else {
            $order->update([
                'customer_email' => $session->customer_details->email ?? $session->customer_email ?? $order->customer_email,
                'customer_name' => $session->customer_details->name ?? $order->customer_name,
                'stripe_payment_intent' => $session->payment_intent,
                'status' => 'paid',
            ]);
        }

        $page_title = 'Purchase Complete — '.$book->title;

        return view('website.purchase-success', compact('page_title', 'book', 'order'));
    }

    public function download(string $token)
    {
        $order = BookOrder::where('download_token', $token)->where('status', 'paid')->first();

        if (! $order || ! $order->book || ! $order->book->file_path) {
            abort(404, 'Download not found or payment not verified.');
        }

        $path = storage_path('app/books/'.$order->book->file_path);

        if (! File::exists($path)) {
            abort(404, 'Book file is missing. Please contact support.');
        }

        if (! $order->downloaded_at) {
            $order->update(['downloaded_at' => now()]);
        }

        $extension = $order->book->file_type ?: 'pdf';
        $filename = Str::slug($order->book->title).'.'.$extension;
        $mime = $extension === 'epub' ? 'application/epub+zip' : 'application/pdf';

        return response()->download($path, $filename, ['Content-Type' => $mime]);
    }
}
