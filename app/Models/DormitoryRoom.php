<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DormitoryRoom extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'totalBed',
        'occupiedBeds',
        'type',
        'category',
        'status',
    ];

    // Define the relationship to DormitoryBed
    public function beds()
    {
        return $this->hasMany(DormitoryBed::class, 'room_id'); // Specify the foreign key
    }
}
