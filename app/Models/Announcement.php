<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Announcement extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = ['id'];
    public static $rules = [
        'title' => 'required',
        'content' => 'required',
        'postedBy' => 'required',
    ];

    protected $fillable = [
        'title',
        'content',
        'user_id',
        'img_path',
        'receiver',
        'branch'
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
