<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'username',
        'firstName',
        'lastName',
        'dayofBirth',
        'gender',
        'password',
        'email',
        'phone',
        'photo',
        'address',
        'country',
        'role',
        'point',
        'status',
        'remember_token',
        'created_at',
        'updated_at',
        'email_verified_at',
        'google_refresh_token'
    ];

    protected $hidden = [
        'password',
        'remember_token', // Ẩn các trường quan trọng khỏi JSON
    ];

    protected $casts = [
        'email_verified_at' => 'datetime', // Ép kiểu cho email_verified_at
    ];
}
