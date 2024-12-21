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
        'code',
        'price',
        'comparePrice',
        'images',
        'description',
        'maxChair',
        'maxTable',
        'maxPeople',
        'tags',
        'startAt',
        'endAt',
        'status',
        'furniture',
        'weekPrice',
        'monthPrice',
        'yearPrice',
        'weekendPrice',
        'holidayPrice',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'price' => 'integer',
        'comparePrice' => 'integer',
        'maxChair' => 'integer',
        'maxTable' => 'integer',
        'maxPeople' => 'integer',
        'weekPrice' => 'integer',
        'monthPrice' => 'integer',
        'yearPrice' => 'integer',
        'weekendPrice' => 'integer',
        'holidayPrice' => 'integer',
        'startAt' => 'datetime',
        'endAt' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function building(): BelongsTo
    {
        return $this->belongsTo(Buildings::class);
    }
}
