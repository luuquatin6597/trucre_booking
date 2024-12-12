<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Buildings extends Model
{
    protected $table = 'buildings';

    protected $fillable = [
        'name',
        'description',
        'address',
        'country',
        'map',
        'status'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function rooms()
    {
        return $this->hasMany(Rooms::class);
    }

}
