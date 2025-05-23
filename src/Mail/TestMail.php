<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct() {}

    public function build(): static
    {
        return $this->subject('This is a test mail.')
            ->markdown('emails.test-mail');
    }
}
