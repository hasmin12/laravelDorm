<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnouncementReport extends Model
{
    use HasFactory;
    protected $fillable = [
        'announcementId',
        'residentName',
        'engagement',
    ];
}
