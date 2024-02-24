<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'phone',
        'visit_date',
        'user_id',
        'relationship',
        'purpose',
        'validId',
    ];
}