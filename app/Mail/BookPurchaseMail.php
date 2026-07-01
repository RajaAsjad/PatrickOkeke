<?php

namespace App\Mail;

use App\Models\BookOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookPurchaseMail extends Mailable
{
    use Queueable, SerializesModels;

    public BookOrder $order;

    public function __construct(BookOrder $order)
    {
        $this->order = $order->loadMissing('book');
    }

    public function build()
    {
        $bookTitle = $this->order->book->title ?? 'Book';

        return $this->subject('New book purchase: ' . $bookTitle)
            ->view('emails.book-purchase');
    }
}
