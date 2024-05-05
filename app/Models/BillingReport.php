<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingReport extends Model
{
    use HasFactory;
    protected $fillable = [
        'billingId',
        'branch',
        'residentName',
        'roomdetails',
        'totalAmount',
        'payment_month',
        'status',
        'created_at',
        'updated_at',

    ];

    
}
