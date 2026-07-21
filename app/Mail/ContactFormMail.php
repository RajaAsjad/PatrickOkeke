<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contact;

    public function __construct($contact)
    {
        $this->contact = $contact;
    }

    public function build()
    {
        $subject = 'New contact from Baeze Publishing website';
        if (! empty($this->contact['subject'])) {
            $subject = 'Contact: ' . $this->contact['subject'];
        }

        return $this->subject($subject)
            ->view('emails.contact-form');
    }
}
