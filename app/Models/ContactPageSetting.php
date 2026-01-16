<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class ContactPageSetting extends Model
{
    protected $table = 'contact_page_settings';

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
     * Get all contact page settings for frontend
     */
    public static function getContactPageData(): array
    {
        return Cache::remember('contact_page_settings', 3600, function () {
            $settings = self::all()->pluck('value', 'key')->toArray();

            return [
                // Hero Section
                'hero' => [
                    'label' => $settings['hero_label'] ?? null,
                    'headline_line1' => $settings['hero_headline_line1'] ?? null,
                    'headline_line2' => $settings['hero_headline_line2'] ?? null,
                    'paragraph' => $settings['hero_paragraph'] ?? null,
                ],
                // Contact Info Section
                'contact_info' => [
                    'email' => $settings['contact_email'] ?? null,
                    'phone' => $settings['contact_phone'] ?? null,
                    'address_line1' => $settings['contact_address_line1'] ?? null,
                    'address_line2' => $settings['contact_address_line2'] ?? null,
                ],
                // Form Section
                'form' => [
                    'heading_line1' => $settings['form_heading_line1'] ?? null,
                    'heading_line2' => $settings['form_heading_line2'] ?? null,
                    'description' => $settings['form_description'] ?? null,
                ],
                // Map Section
                'map' => [
                    'heading_line1' => $settings['map_heading_line1'] ?? null,
                    'heading_line2' => $settings['map_heading_line2'] ?? null,
                    'description' => $settings['map_description'] ?? null,
                    'embed_url' => $settings['map_embed_url'] ?? null,
                    'overlay_title' => $settings['map_overlay_title'] ?? null,
                    'overlay_subtitle' => $settings['map_overlay_subtitle'] ?? null,
                ],
                // CTA Section
                'cta' => [
                    'heading_line1' => $settings['cta_heading_line1'] ?? null,
                    'heading_line2' => $settings['cta_heading_line2'] ?? null,
                    'paragraph' => $settings['cta_paragraph'] ?? null,
                    'button_text' => $settings['cta_button_text'] ?? null,
                    'button_link' => $settings['cta_button_link'] ?? null,
                ],
            ];
        });
    }

    /**
     * Clear contact page cache
     */
    public static function clearCache(): void
    {
        Cache::forget('contact_page_settings');
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
