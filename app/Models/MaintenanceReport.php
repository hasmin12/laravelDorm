<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceReport extends Model
{
    use HasFactory;
    protected $fillable = [
        'maintenanceId',

        'residentName',
        'type',
        'technicianName',
        'branch',
        'days',
        'status',
    ];
  
}
