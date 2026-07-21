<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewsletterSubscribeMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $subscriberEmail;

    public function __construct(string $subscriberEmail)
    {
        $this->subscriberEmail = $subscriberEmail;
    }

    public function build()
    {
        return $this->subject('New newsletter subscriber')
            ->view('emails.newsletter-subscribe');
    }
}
