<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class AboutPageSetting extends Model
{
    protected $table = 'about_page_settings';

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
     * Get all about page settings for frontend
     */
    public static function getAboutPageData(): array
    {
        return Cache::remember('about_page_settings', 3600, function () {
            $settings = self::all()->pluck('value', 'key')->toArray();

            return [
                // Hero Section
                'hero' => [
                    'label' => $settings['hero_label'] ?? null,
                    'headline_line1' => $settings['hero_headline_line1'] ?? null,
                    'headline_line2' => $settings['hero_headline_line2'] ?? null,
                    'paragraph' => $settings['hero_paragraph'] ?? null,
                ],
                // Intro Section
                'intro' => [
                    'heading_line1' => $settings['intro_heading_line1'] ?? null,
                    'heading_line2' => $settings['intro_heading_line2'] ?? null,
                    'paragraph' => $settings['intro_paragraph'] ?? null,
                    'stat1_value' => $settings['intro_stat1_value'] ?? null,
                    'stat1_label' => $settings['intro_stat1_label'] ?? null,
                    'stat2_value' => $settings['intro_stat2_value'] ?? null,
                    'stat2_label' => $settings['intro_stat2_label'] ?? null,
                    'stat3_value' => $settings['intro_stat3_value'] ?? null,
                    'stat3_label' => $settings['intro_stat3_label'] ?? null,
                ],
                // Journey Section
                'journey' => [
                    'label' => $settings['journey_label'] ?? null,
                    'heading_line1' => $settings['journey_heading_line1'] ?? null,
                    'heading_line2' => $settings['journey_heading_line2'] ?? null,
                    'start_year' => $settings['journey_start_year'] ?? null,
                    'end_year' => $settings['journey_end_year'] ?? null,
                    'paragraph1' => $settings['journey_paragraph1'] ?? null,
                    'paragraph2' => $settings['journey_paragraph2'] ?? null,
                ],
                // Excellence Section
                'excellence' => [
                    'label' => $settings['excellence_label'] ?? null,
                    'heading_line1' => $settings['excellence_heading_line1'] ?? null,
                    'heading_line2' => $settings['excellence_heading_line2'] ?? null,
                    'paragraph1' => $settings['excellence_paragraph1'] ?? null,
                    'paragraph2' => $settings['excellence_paragraph2'] ?? null,
                    'feature1_title' => $settings['excellence_feature1_title'] ?? null,
                    'feature1_desc' => $settings['excellence_feature1_desc'] ?? null,
                    'feature2_title' => $settings['excellence_feature2_title'] ?? null,
                    'feature2_desc' => $settings['excellence_feature2_desc'] ?? null,
                    'feature3_title' => $settings['excellence_feature3_title'] ?? null,
                    'feature3_desc' => $settings['excellence_feature3_desc'] ?? null,
                    'badge_value' => $settings['excellence_badge_value'] ?? null,
                    'badge_label' => $settings['excellence_badge_label'] ?? null,
                ],
                // Vision/CTA Section
                'vision' => [
                    'label' => $settings['vision_label'] ?? null,
                    'heading_line1' => $settings['vision_heading_line1'] ?? null,
                    'heading_line2' => $settings['vision_heading_line2'] ?? null,
                    'paragraph' => $settings['vision_paragraph'] ?? null,
                    'primary_button_text' => $settings['vision_primary_button_text'] ?? null,
                    'primary_button_link' => $settings['vision_primary_button_link'] ?? null,
                    'secondary_button_text' => $settings['vision_secondary_button_text'] ?? null,
                    'secondary_button_link' => $settings['vision_secondary_button_link'] ?? null,
                ],
            ];
        });
    }

    /**
     * Clear about page cache
     */
    public static function clearCache(): void
    {
        Cache::forget('about_page_settings');
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
