<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Laundryschedule extends Model
{
    use HasFactory;
    use SoftDeletes;

    public static $rules = [
        'user_id' => 'required',
      
        'laundrydate' => 'required',
      
        'laundrytime' => 'required',
    
    ];
    protected $fillable = [
        'user_id' ,
        'laundrydate',
        'laundrytime',
        'branch',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
