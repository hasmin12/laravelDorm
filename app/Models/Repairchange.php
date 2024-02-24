<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repairchange extends Model
{
    use HasFactory;
    protected $fillable = [
        'repair_id',
        'description',
        'changePercentage',
    ];
}
