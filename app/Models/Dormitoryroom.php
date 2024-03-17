<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Dormitorybed;

class Dormitoryroom extends Model
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
        'occupiedBeds' => 'required',
    ];

    public function beds()
    {
        return $this->hasMany(Dormitorybed::class);
    }
}
