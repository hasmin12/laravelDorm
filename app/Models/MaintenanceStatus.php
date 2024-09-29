<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'maintenance_id',
        'title',
        'percentage',
        'message',
    ];

    protected $casts = [
        'percentage' => 'integer',
    ];

    /**
     * Get the maintenance request associated with this status.
     */
    public function maintenanceRequest()
    {
        return $this->belongsTo(MaintenanceRequest::class, 'maintenance_id');
    }
}
