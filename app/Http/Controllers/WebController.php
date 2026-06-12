<?php

namespace App\Http\Controllers;

use App\Models\Book;

class WebController extends Controller
{
    public function Index()
    {
        $page_title = 'Patrick Okeke — Author of Culture, Technology & Craft';
        $meta_description = 'Official author site of Patrick Okeke. Explore featured books, essays and the writing journey behind them.';
        $books = Book::active()->featured()->ordered()->take(4)->get();

        return view('website.index', compact('page_title', 'meta_description', 'books'));
    }

    public function About()
    {
        $page_title = 'About — Patrick Okeke';
        $meta_description = 'The story behind Patrick Okeke — books and essays on culture, technology, and the craft of a thinking life.';

        return view('website.about', compact('page_title', 'meta_description'));
    }

    public function Books()
    {
        $page_title = 'Books — Patrick Okeke';
        $meta_description = 'All books by Patrick Okeke — independently published works on culture, technology, and craft.';
        $books = Book::active()->ordered()->get();

        return view('website.books', compact('page_title', 'meta_description', 'books'));
    }

    public function BookShow(string $slug)
    {
        $book = Book::active()->where('slug', $slug)->firstOrFail();
        $page_title = $book->title.' — Patrick Okeke';
        $meta_description = $book->description;

        return view('website.book-show', compact('page_title', 'book'));
    }

    public function Contact()
    {
        $page_title = 'Contact — Patrick Okeke';
        $meta_description = 'Write to Patrick Okeke — reader letters, press, speaking and rights inquiries.';

        return view('website.contact', compact('page_title', 'meta_description'));
    }
}
