<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Certificates extends Model
{
    protected $table = 'certificates';

    protected $fillable = [
        'id',
        'building_id',
        'url'
    ];

    // Quan hệ với model Buildings
    public function building(): BelongsTo
    {
        return $this->belongsTo(Buildings::class, 'building_id');
    }
}
