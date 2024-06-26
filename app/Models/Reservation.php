<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable = [
        'room_id',
        'reservation_date',
        'checkin_date',
        'checkout_date',
        'downPayment',
        'totalPayment',
        'name',
        'email',
        'password',
        'review',
        'role',
        'branch',
        'img_path',
        'remember_token',
        'address',
        'sex',
        'birthdate',
        'contacts',
        'status',
        'downreceipt',
        'receipt',
        'roomName',
        'qrcode',
        'qrcodeImage',
    ];

    public function room()
    {
        return $this->belongsTo(Hostelroom::class, 'room_id');
    }

}
