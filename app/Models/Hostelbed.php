<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Hostelroom;
use App\Models\User;
class Hostelbed extends Model
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
        return $this->belongsTo(Hostelroom::class, 'room_id');
    }

    public function resident()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
