<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'role',
        'branch',
        'type',
        'img_path',
        'remember_token',
        'course',
        'year',
        'birthdate',
        'age',
        'sex',
        'religion',
        'civil_status',
        'address',
        'contactNumber',
        'Tuptnum',
        'contract',
        'cor',
        'validID',
        'vaccineCard',
        'laptop',
        'electricfan',
        'lastpaidDate',
        'is_paid',
        'is_scheduled',
        'roomdetails',
        'status',
        'specialization',
        'guardianName',
        'guardianContactNumber',
        'guardianAddress',
        'guardianRelationship',
        'applicationForm'

    ];
}
