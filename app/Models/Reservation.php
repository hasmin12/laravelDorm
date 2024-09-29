<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    use HasFactory;

    protected $fillable = [
        'hostel_room_id',
        'user_id',
        'check_in_date',
        'check_out_date',
        'receipt',
        'total_price',
        'status',
    ];

    /**
     * Get the hostel room associated with the reservation.
     */
    public function hostelRoom()
    {
        return $this->belongsTo(HostelRoom::class);
    }

    /**
     * Get the user that owns the reservation.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
