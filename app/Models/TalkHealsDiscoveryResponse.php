<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TalkHealsDiscoveryResponse extends Model
{
    protected $table = 'talkheals_discovery_responses';

    protected $fillable = ['answers', 'is_reviewed'];

    protected $casts = [
        'answers'     => 'array',
        'is_reviewed' => 'boolean',
    ];
}
