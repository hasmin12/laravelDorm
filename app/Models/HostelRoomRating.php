<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HostelRoomRating extends Model
{
    use HasFactory;

    protected $fillable = [
        'hostel_room_id',
        'user_id',
        'rating',
        'review',
    ];

    public function hostelRoom()
    {
        return $this->belongsTo(HostelRoom::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class); // Assuming you have a User model
    }
}
