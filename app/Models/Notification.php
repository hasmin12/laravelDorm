<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'receiver_id',
        'sender_id',
        'notification_type',
        'target_id',
        'message',
        'status',
    ];

    /**
     * Get the receiver user for the notification.
     */
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    /**
     * Get the sender user for the notification.
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
