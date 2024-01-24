<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repair extends Model
{
    use HasFactory;
    protected $fillable = [
        'room_number',
        'request_date',
        'itemName',
        'description',
        'branch',
        'technicianName',
        'residentName',
        'completion_date',
        'cost',
        'img_path',
        'status',
    ];

    /**
     * Get the technician associated with the repair.
     */
    public function technician()
    {
        return $this->belongsTo(Technician::class);
    }

    /**
     * Get the user associated with the repair.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
