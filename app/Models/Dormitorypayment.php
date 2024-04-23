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
    return self::whereMonth('created_at', Carbon::now()->month)
               ->whereYear('created_at', Carbon::now()->year)
               ->where('status', 'PAID') // Assuming you want to count only PAID payments
               ->sum('totalAmount');
}



    public static function getTotalIncome()
    {
        return self::where('status', 'PAID')->sum('totalAmount');
    }
}
