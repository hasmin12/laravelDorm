<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;
    protected $fillable = [
        'Tuptnum',
        'name',
        'email',
        'type',

        'password',
        'sex',
        'birthdate',
        'address',
        'contacts',
        'contract',
        'cor',
        'validId',
        'vaccineCard',
    ];
}
