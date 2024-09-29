<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course',
        'year',
        'birthdate',
        'age',
        'religion',
        'civil_status',
        'address',
        'contactNumber',
        'Tuptnum',
        'contract',
        'cor',
        'validID',
        'vaccineCard',
        'applicationForm',
        'laptop',
        'electricfan',
        'guardianName',
        'guardianAddress',
        'guardianContactNumber',
        'guardianRelationship',
        'is_paid',
        'is_scheduled',
    ];
}
