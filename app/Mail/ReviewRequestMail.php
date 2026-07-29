<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReviewRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $event;
    public $transaction;

    public function __construct($event, $transaction)
    {
        $this->event = $event;
        $this->transaction = $transaction;
    }

    public function build()
    {
        return $this->subject('Berikan Ulasan untuk Acara yang Anda Hadiri')
            ->view('emails.review_request')
            ->with([
                'event' => $this->event,
                'transaction' => $this->transaction,
            ]);
    }
}
