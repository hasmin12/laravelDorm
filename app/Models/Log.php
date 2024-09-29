<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'reason',
        'gatepass',
        'status',
        'log_date',
        'date_of_leave',
        'expected_return',
        'returned_date',
    ];

    protected $casts = [
        'log_date' => 'datetime',
        'date_of_leave' => 'datetime',
        'expected_return' => 'datetime',
        'returned_date' => 'datetime',
    ];

    /**
     * Get the user associated with the log.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
