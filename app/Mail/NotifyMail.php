<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifyMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $month;

    /**
     * Create a new message instance.
     */
    public function __construct($month)
    {
        $this->month = $month;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Monthly Payment Reminder')
            ->view('mails.notifyresidents')
            ->with(['month' => $this->month]);
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
