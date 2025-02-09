<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    protected $table = 'images';
    protected $fillable = [
        'room_id',
        'url'
    ];

    public function room()
    {
        return $this->belongsTo(Rooms::class);
    }
}
