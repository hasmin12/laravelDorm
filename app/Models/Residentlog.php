<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Residentlog extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'purpose',
        'leave_date',
        'return_date',
        'gatepass',
        'expectedReturn',
        'dateLog'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
