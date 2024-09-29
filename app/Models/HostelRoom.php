<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HostelRoom extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'floorNumber',
        'beds',
        'price',
        'pax',
        'rating',
        'status',
    ];

    // Relationship with images
    public function images()
    {
        return $this->hasMany(HostelRoomImage::class);
    }

    // Relationship with ratings
    public function ratings()
    {
        return $this->hasMany(HostelRoomRating::class);
    }

    public function getAverageRating()
    {
        return $this->ratings()->avg('rating') ?? 0;
    }

    public function getRatingCount()
    {
        return $this->ratings()->count();
    }
}
