<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SuccessStory extends Model
{
    protected $table = 'success_stories';

    protected $fillable = [
        'company',
        'industry',
        'tagline',
        'image',
        'stat1_value',
        'stat1_label',
        'stat2_value',
        'stat2_label',
        'stat3_value',
        'stat3_label',
        'challenge',
        'solution',
        'outcome',
        'takeaway',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
    ];

    /**
     * Model boot
     */
    protected static function booted()
    {
        static::saved(function () {
            SuccessStoriesPageSetting::clearCache();
        });

        static::deleted(function () {
            SuccessStoriesPageSetting::clearCache();
        });
    }
}
