<?php

// app/Models/LaundrySchedule.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaundrySchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'scheduled_at',
        'status',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
    ];

    // Relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
