<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TalkHealsPsychlabResponse extends Model
{
    protected $table = 'talkheals_psychlab_responses';

    protected $fillable = ['scores', 'completed_games', 'is_reviewed'];

    protected $casts = [
        'scores'          => 'array',
        'completed_games' => 'array',
        'is_reviewed'     => 'boolean',
    ];
}
