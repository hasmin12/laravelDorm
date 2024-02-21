<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class Violation extends Model
{
    
    use HasFactory;
    use softDeletes;
    protected $guarded = ['id'];
    public static $rules = [
        'violationName' => 'required',
        'penalty' => 'required',
        'violationDate' => 'required|date',
        'violationType' => 'required',
        'status' => 'required',
    ];

    public function resident()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
