<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LostAndFound extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner',
        'contact_number',
        'item_name',
        'description',
        'status',
        'reported_at',
        'image_path',

    ];

    protected $casts = [
        'reported_at' => 'datetime',
    ];

    /**
     * Get the user associated with the lost or found item.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
