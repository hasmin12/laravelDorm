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
        // 'minitial' => 'required',
        'totalBed' => 'required',
        'availableBed' => 'required',
    ];

    public function beds()
    {
        return $this->hasMany(Hostelbed::class);
    }
}