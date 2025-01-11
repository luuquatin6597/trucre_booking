<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Rooms extends Model
{
    protected $table = 'rooms';

    protected $fillable = [
        'building_id',
        'name',
        'price',
        'comparePrice',
        'description',
        'maxChair',
        'maxTable',
        'maxPeople',
        'tags',
        'startAt',
        'endAt',
        'status',
        'furniture',
        'created_at',
        'updated_at',
        'allDayPrice',
        'sessionPrice',
        'type',
    ];

    protected $casts = [
        'price' => 'integer',
        'comparePrice' => 'integer',
        'maxChair' => 'integer',
        'maxTable' => 'integer',
        'maxPeople' => 'integer',
        'allDayPrice' => 'integer',
        'sessionPrice' => 'integer',
        'startAt' => 'datetime',
        'endAt' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function building(): BelongsTo
    {
        return $this->belongsTo(Buildings::class);
    }

    public function bookings()
    {
        return $this->hasMany(Bookings::class, 'room_id');
    }
}
