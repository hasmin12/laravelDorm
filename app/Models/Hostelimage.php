<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hostelimage extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public static $rules = [
        'room_id' => 'required',
        'path' => 'required',
    ];

}
