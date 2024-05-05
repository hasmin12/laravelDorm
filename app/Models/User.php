<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;



class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
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
        'applicationForm',
        'laptop',
        'electricfan',
        'lastpaidDate',
        'is_paid',
        'is_scheduled',
        'room',
        'bed',
        'status',
        'specialization',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function laundrySchedules()
    {
        return $this->hasMany(Laundryschedule::class, 'user_id');
    }
}
