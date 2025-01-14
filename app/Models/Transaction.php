<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'booking_id',
        'transaction_id',
        'payment_method',
        'totalPrice',
        'currency',
        'status',
        'payment_data',
        'room_id',
        'price',
        'tax',
        'startAt',
        'endAt',
        'bookingType',
        'sessionType',
        'userName',
        'userEmail',
        'userPhone'
    ];
}