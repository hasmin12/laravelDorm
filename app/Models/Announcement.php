<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'message',
        'published_at',
        'status',
        'image_path'
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];
}
