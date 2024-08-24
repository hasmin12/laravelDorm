<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Reservation;
use Illuminate\Support\Facades\Storage;
class ReservationConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $qrCodePath = $this->reservation->qrcodeImage;
    
        return $this->view('mails.reservation_confirmation')
                    ->attach(Storage::path($qrCodePath), [
                        'as' => 'qrcode.png',
                        'mime' => 'image/png',
                    ])
                    ->with([
                        'reservation' => $this->reservation,
                    ]);
    }

}
