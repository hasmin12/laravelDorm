<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenancechange extends Model
{
    use HasFactory;
    protected $fillable = [
        'maintenance_id',
        'description',
        'changePercentage',
    ];
}
