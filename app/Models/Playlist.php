<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Playlist extends Model
{
    protected $fillable = [
        'name',
        'user_id',
        'cover_url'
    ];

    public function tracks(): BelongsToMany
    {
        return $this->belongsToMany(Track::class);
    }
}
