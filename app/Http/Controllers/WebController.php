<?php

namespace App\Http\Controllers;

class WebController extends Controller
{
    public function Index()
    {
        $page_title = 'Patrick Okeke — Author of Culture, Technology & Craft';
        $meta_description = 'Official author site of Patrick Okeke. Explore featured books, essays and the writing journey behind them.';
        $books = config('website.books');

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
        $books = config('website.books');

        return view('website.books', compact('page_title', 'meta_description', 'books'));
    }

    public function Contact()
    {
        $page_title = 'Contact — Patrick Okeke';
        $meta_description = 'Write to Patrick Okeke — reader letters, press, speaking and rights inquiries.';

        return view('website.contact', compact('page_title', 'meta_description'));
    }
}
