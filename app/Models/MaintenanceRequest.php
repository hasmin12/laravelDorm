<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'maintenance_user_id',  // Added maintenance_user_id
        'room_details',  // Added maintenance_user_id

        'type',
        'description',
        'status',
        'image_path',
        'requested_at',
        'completion_percentage',  // Added completion_percentage
    ];

    protected $casts = [
        'requested_at' => 'datetime',
        'completion_percentage' => 'integer',  // Cast completion_percentage to integer
    ];

    /**
     * Get the user associated with the maintenance request.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the maintenance user associated with the maintenance request.
     */
    public function maintenanceUser()
    {
        return $this->belongsTo(User::class, 'maintenance_user_id');
    }

    public function maintenanceStatus()
    {
        return $this->hasMany(MaintenanceStatus::class, 'maintenance_id');
    }
}
