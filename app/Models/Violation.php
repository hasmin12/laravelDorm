<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Violation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'violation_name',
        'violation_type',
        'penalty',

        'details',
        'status',
        'reported_at',
    ];

    protected $casts = [
        'reported_at' => 'datetime',
    ];

    /**
     * Get the user associated with the violation.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
