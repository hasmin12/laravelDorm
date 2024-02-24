<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Dormitorypayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'roomdetails',
        'laptop',
        'electricfan',
        'totalAmount',
        'payment_month',
        'receipt',
        'img_path',
        'paidDate',
        'status'
    ];

    public static function getThisMonthsIncome()
    {
        return self::whereMonth('paidDate', Carbon::now()->month)
            ->whereYear('paidDate', Carbon::now()->year)
            ->sum('totalAmount');
    }

    public static function getTotalIncome()
    {
        return self::sum('totalAmount');
    }
}
