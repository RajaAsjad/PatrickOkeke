<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use App\Mail\NewsletterSubscribeMail;
use App\Models\Book;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class WebController extends Controller
{
    public function Index()
    {
        $page_title = 'Patrick Okeke | Author of Culture, Technology & Craft'; 
        $meta_description = 'Official author site of Patrick Okeke. Explore featured books, essays and the writing journey behind them.';
        $books = Book::active()->featured()->ordered()->take(4)->get();

        return view('website.index', compact('page_title', 'meta_description', 'books'));
    }

    public function About()
    {
        $page_title = 'About | Patrick Okeke';
        $meta_description = 'The story behind Patrick Okeke: books and essays on culture, technology, and the craft of a thinking life.';

        return view('website.about', compact('page_title', 'meta_description'));
    }

    public function Books()
    {
        $page_title = 'Books | Patrick Okeke';
        $meta_description = 'All books by Patrick Okeke: independently published works on culture, technology, and craft.';
        $books = Book::active()->ordered()->get();

        return view('website.books', compact('page_title', 'meta_description', 'books'));
    }

    public function BookShow(string $slug)
    {
        $book = Book::active()->where('slug', $slug)->firstOrFail();
        $page_title = $book->title.' | Patrick Okeke';
        $meta_description = $book->description;

        return view('website.book-show', compact('page_title', 'book'));
    }

    public function Contact()
    {
        $page_title = 'Contact | Patrick Okeke';
        $meta_description = 'Write to Patrick Okeke for reader letters, press, speaking and rights inquiries.';

        return view('website.contact', compact('page_title', 'meta_description'));
    }

    public function submitContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:200',
            'email' => 'required|email|max:100',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        $fullName = trim($request->name);
        $parts = preg_split('/\s+/', $fullName, 2);
        $firstName = $parts[0] ?? $fullName;
        $lastName = $parts[1] ?? '';

        $model = new ContactUs();
        $model->first_name = $firstName;
        $model->last_name = $lastName;
        $model->email = $request->email;
        $model->address = $request->subject;
        $model->message = $request->message;
        $model->save();

        $contactData = [
            'name' => $fullName,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ];

        $adminEmail = config('mail.admin.address');

        try {
            Mail::to($adminEmail)->send(new ContactFormMail($contactData));
            Log::info('Contact form email sent to ' . $adminEmail);
        } catch (\Exception $e) {
            Log::error('Contact form email failed', [
                'to' => $adminEmail,
                'message' => $e->getMessage(),
            ]);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'We could not send your letter right now. Please try again shortly.',
                ], 500);
            }

            return redirect()->back()->withErrors(['message' => 'We could not send your letter right now. Please try again shortly.']);
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Your letter has been sent. Thank you.',
            ]);
        }

        return redirect()->back()->with('status', 'Your letter has been sent. Thank you.');
    }

    public function submitNewsletter(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
        ]);

        $adminEmail = config('mail.admin.address');

        try {
            Mail::to($adminEmail)->send(new NewsletterSubscribeMail($request->email));
            Log::info('Newsletter subscribe email sent to ' . $adminEmail, [
                'subscriber' => $request->email,
            ]);
        } catch (\Exception $e) {
            Log::error('Newsletter subscribe email failed', [
                'to' => $adminEmail,
                'message' => $e->getMessage(),
            ]);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'We could not save your email right now. Please try again shortly.',
                ], 500);
            }

            return redirect()->back()->withErrors(['email' => 'We could not save your email right now.']);
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Thank you. You are on the list.',
            ]);
        }

        return redirect()->back()->with('status', 'Thank you. You are on the list.');
    }
}
