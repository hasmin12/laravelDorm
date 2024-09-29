<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice',
        'user_id',
        'amount',
        'laptop',
        'electricfan',
        'payment_date',
        'status',
        'current_month',
        'or_number',   // Add or_number to fillable
        'or_image',    // Add or_image to fillable
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'laptop' => 'boolean',
        'electricfan' => 'boolean',
        'payment_date' => 'datetime',
        'current_month' => 'string',
        'or_number' => 'string',  // Cast as a string
        'or_image' => 'string',    // Cast as a string
    ];

    /**
     * Get the user associated with the payment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
