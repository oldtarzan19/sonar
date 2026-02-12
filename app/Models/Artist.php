<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class Artist extends Model
{
    protected $fillable = [
        'artist_name',
        'description',
        'logo_url',
        'cover_url'
    ];

    public function user(): BelongsTo 
    {
        return $this->belongsTo(User::class);
    }
}
