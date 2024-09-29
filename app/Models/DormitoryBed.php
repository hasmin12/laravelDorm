<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DormitoryBed extends Model
{
    use HasFactory;
    protected $fillable = [
        'room_id',
        'user_id',
        'name',
        'status',
    ];

    public function room()
    {
        return $this->belongsTo(DormitoryRoom::class, 'room_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
