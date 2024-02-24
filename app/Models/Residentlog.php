<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Residentlog extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'purpose',
        'leave_date',
        'return_date',
        'gatepass'

    ];
}
