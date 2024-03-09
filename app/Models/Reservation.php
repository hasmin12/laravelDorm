<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'room_id',
        'reservation_date',
        'checkin_date',
        'checkout_date',
        'downPayment',
        'totalPayment',
        'name',
        'email',
        'password',
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
        'roomName'
    ];

    public function room()
    {
        return $this->belongsTo(Hostelroom::class, 'room_id');
    }

}
