<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Chirp extends Model
{
    use HasFactory;
    protected $fillable = [

        'message',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // public function upvotes(): BelongsToMany
    // {
    //     return $this->belongsToMany(User::class, 'chirp_upvotes')->withTimestamps();
    // }

    public function upvotes(): HasMany
    {
        return $this->hasMany(ChirpUpvote::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(ChirpComment::class);
    }
}
