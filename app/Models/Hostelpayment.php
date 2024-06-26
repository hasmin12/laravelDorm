<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Hostelpayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'room_id',
        'reservation_id',
        'totalAmount',
        'payment_date',
    ];

    public static function getThisMonthsIncome()
    {
        return self::whereMonth('payment_date', Carbon::now()->month)
            ->whereYear('payment_date', Carbon::now()->year)
            ->sum('totalAmount');
    }

    public static function getTotalIncome()
    {
        return self::sum('totalAmount');
    }
}
