<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class HomepageSetting extends Model
{
    protected $table = 'homepage_settings';

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
     * Get all homepage settings for frontend
     */
    public static function getHomepageData(): array
    {
        return Cache::remember('homepage_settings', 3600, function () {
            $settings = self::all()->pluck('value', 'key')->toArray();

            return [
                // Hero Section
                'hero' => [
                    'video_url' => $settings['hero_video_url'] ?? null,
                    'headline_line1' => $settings['hero_headline_line1'] ?? null,
                    'headline_line2' => $settings['hero_headline_line2'] ?? null,
                    'subheadline' => $settings['hero_subheadline'] ?? null,
                    'primary_button_text' => $settings['hero_primary_button_text'] ?? null,
                    'primary_button_link' => $settings['hero_primary_button_link'] ?? null,
                    'secondary_button_text' => $settings['hero_secondary_button_text'] ?? null,
                    'secondary_button_link' => $settings['hero_secondary_button_link'] ?? null,
                ],
                // Blog Carousel Section
                'blog_carousel' => [
                    'heading_line1' => $settings['blog_carousel_heading_line1'] ?? null,
                    'heading_line2' => $settings['blog_carousel_heading_line2'] ?? null,
                    'paragraph' => $settings['blog_carousel_paragraph'] ?? null,
                ],
            ];
        });
    }

    /**
     * Clear homepage cache
     */
    public static function clearCache(): void
    {
        Cache::forget('homepage_settings');
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
