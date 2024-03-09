<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Hostelbed;

class Hostelroom extends Model
{
    use HasFactory;
    use softDeletes;
    protected $guarded = ['id'];
    public static $rules = [
        'name' => 'required',
        'details' => 'required',
        'price' => 'required',
        'totalBed' => 'required',
        'availableBed' => 'required',
    ];

    protected $fillable = [
        'name',
        'description',
        'floorNum',
        'type',
        'pax',
        'price',
        'status',
        'img_path',
        'user_id',
    ];
    public function beds()
    {
        return $this->hasMany(Hostelbed::class);
    }

    public function images()
    {
        return $this->hasMany(Hostelimage::class, 'room_id');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'room_id');
    }
}
