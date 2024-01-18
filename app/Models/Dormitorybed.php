<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Dormitoryroom;
use App\Models\User;
class Dormitorybed extends Model
{
    use HasFactory;
    use softDeletes;
    protected $guarded = ['id'];
    public static $rules = [
        'name' => 'required',
        'details' => 'required',
        'room_id' => 'required',
        // 'minitial' => 'required',
        'status' => 'required',
    ];

    public function room()
    {
        return $this->belongsTo(Dormitoryroom::class, 'room_id');
    }

    public function resident()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
