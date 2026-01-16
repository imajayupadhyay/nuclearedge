<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class BlogPageSetting extends Model
{
    protected $table = 'blog_page_settings';

    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
        'label',
        'order',
    ];

    /**
     * Get a setting value by key
     */
    public static function get(string $key, $default = null)
    {
        $setting = self::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    /**
     * Set a setting value
     */
    public static function set(string $key, $value): void
    {
        self::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
        self::clearCache();
    }

    /**
     * Get all blog page settings for frontend
     */
    public static function getBlogPageData(): array
    {
        return Cache::remember('blog_page_settings', 3600, function () {
            $settings = self::all()->pluck('value', 'key')->toArray();

            return [
                // Hero Section
                'hero' => [
                    'label' => $settings['hero_label'] ?? null,
                    'headline_line1' => $settings['hero_headline_line1'] ?? null,
                    'headline_line2' => $settings['hero_headline_line2'] ?? null,
                    'paragraph' => $settings['hero_paragraph'] ?? null,
                ],
            ];
        });
    }

    /**
     * Clear blog page cache
     */
    public static function clearCache(): void
    {
        Cache::forget('blog_page_settings');
    }

    /**
     * Model boot
     */
    protected static function booted()
    {
        static::saved(function () {
            self::clearCache();
        });

        static::deleted(function () {
            self::clearCache();
        });
    }
}
