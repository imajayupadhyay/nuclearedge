<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SuccessStoriesPageSetting extends Model
{
    protected $table = 'success_stories_page_settings';

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
     * Get all success stories page settings for frontend
     */
    public static function getSuccessStoriesPageData(): array
    {
        return Cache::remember('success_stories_page_settings', 3600, function () {
            $settings = self::all()->pluck('value', 'key')->toArray();
            $stories = SuccessStory::where('is_active', true)
                ->orderBy('order')
                ->get()
                ->map(function ($story) {
                    return [
                        'id' => $story->id,
                        'company' => $story->company,
                        'industry' => $story->industry,
                        'tagline' => $story->tagline,
                        'image' => $story->image,
                        'stats' => array_filter([
                            $story->stat1_value ? ['value' => $story->stat1_value, 'label' => $story->stat1_label] : null,
                            $story->stat2_value ? ['value' => $story->stat2_value, 'label' => $story->stat2_label] : null,
                            $story->stat3_value ? ['value' => $story->stat3_value, 'label' => $story->stat3_label] : null,
                        ]),
                        'challenge' => $story->challenge,
                        'solution' => $story->solution,
                        'outcome' => $story->outcome,
                        'takeaway' => $story->takeaway,
                    ];
                })
                ->toArray();

            return [
                // Hero Section
                'hero' => [
                    'label' => $settings['hero_label'] ?? null,
                    'headline_line1' => $settings['hero_headline_line1'] ?? null,
                    'headline_line2' => $settings['hero_headline_line2'] ?? null,
                    'paragraph' => $settings['hero_paragraph'] ?? null,
                ],
                // Success Stories
                'stories' => $stories,
                // CTA Section
                'cta' => [
                    'heading_line1' => $settings['cta_heading_line1'] ?? null,
                    'heading_line2' => $settings['cta_heading_line2'] ?? null,
                    'paragraph' => $settings['cta_paragraph'] ?? null,
                    'primary_button_text' => $settings['cta_primary_button_text'] ?? null,
                    'primary_button_link' => $settings['cta_primary_button_link'] ?? null,
                    'secondary_button_text' => $settings['cta_secondary_button_text'] ?? null,
                    'secondary_button_link' => $settings['cta_secondary_button_link'] ?? null,
                ],
            ];
        });
    }

    /**
     * Clear success stories page cache
     */
    public static function clearCache(): void
    {
        Cache::forget('success_stories_page_settings');
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
