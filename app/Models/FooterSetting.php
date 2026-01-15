<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class FooterSetting extends Model
{
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
     * Get all settings grouped for frontend
     */
    public static function getFooterData(): array
    {
        return Cache::remember('footer_settings', 3600, function () {
            $settings = self::all()->pluck('value', 'key')->toArray();

            // Parse quick_links JSON if exists
            if (isset($settings['quick_links'])) {
                $settings['quick_links'] = json_decode($settings['quick_links'], true) ?? [];
            }

            // Parse social_links JSON if exists
            if (isset($settings['social_links'])) {
                $settings['social_links'] = json_decode($settings['social_links'], true) ?? [];
            }

            return $settings;
        });
    }

    /**
     * Get settings grouped by group for admin
     */
    public static function getGroupedSettings(): array
    {
        return self::orderBy('group')->orderBy('order')->get()->groupBy('group')->toArray();
    }

    /**
     * Clear footer cache
     */
    public static function clearCache(): void
    {
        Cache::forget('footer_settings');
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
