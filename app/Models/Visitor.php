<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'visitor_name',
        'visitor_contact',
        'visit_purpose',
        'visit_date',
    ];

    protected $casts = [
        'visit_date' => 'datetime',
    ];

    /**
     * Get the user associated with the visitor.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
