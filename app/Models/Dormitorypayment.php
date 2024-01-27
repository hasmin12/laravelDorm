<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dormitorypayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'room_id',
        'laptop',
        'electricfan',
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
