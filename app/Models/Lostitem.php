<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lostitem extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'itemName',
        'dateLost',
        'locationLost',
        'findersName',
        'img_path',
        'claimedBy',
        'claimedDate',
        'status'
    ];

    public static $rules = [
        'itemName' => 'required',
      
        'dateLost' => 'required',
    
        'locationLost' => 'required',
        'findersName' => 'required',
        'claimedBy','claimedDate','status'
        
    ];
}
