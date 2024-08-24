<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
class ConfirmationMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $applicantName;
    public $paymentDueDays;
    public $totalAmount;
    public $laptopIncluded;
    public $electricFanIncluded;

    /**
     * Create a new message instance.
     */
    public function __construct($applicantName, $paymentDueDays, $totalAmount, $laptopIncluded, $electricFanIncluded)
    {
        $this->applicantName = $applicantName;
        $this->paymentDueDays = $paymentDueDays;
        $this->totalAmount = $totalAmount;
        $this->laptopIncluded = $laptopIncluded;
        $this->electricFanIncluded = $electricFanIncluded;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Registration Confirmation')
            ->view('mails.confirmationEmail')
            ->with([
                'applicantName' => $this->applicantName,
                'paymentDueDays' => $this->paymentDueDays,
                'totalAmount' => $this->totalAmount,
                'laptopIncluded' => $this->laptopIncluded,
                'electricFanIncluded' => $this->electricFanIncluded,
            ]);
    }
}
