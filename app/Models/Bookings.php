<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookings extends Model
{
    use HasFactory;

    protected $table = 'bookings';

    protected $fillable = [
        'user_id',
        'room_id',
        'tax',
        'totalPrice',
        'status',
        'userName',
        'userEmail',
        'userPhone',
        'payment_method',
        'startAt',
        'endAt',
        'bookingType',
        'sessionType',
        'currency',
    ];

    // Quan hệ với user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function room()
    {
        return $this->belongsTo(Rooms::class, 'room_id', 'id');
    }
}