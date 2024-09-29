<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HostelRoomImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'hostel_room_id',
        'image_path',
    ];

    public function hostelRoom()
    {
        return $this->belongsTo(HostelRoom::class);
    }
}
