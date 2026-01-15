<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class MenuItem extends Model
{
    protected $fillable = [
        'title',
        'url',
        'icon',
        'parent_id',
        'order',
        'open_in_new_tab',
        'status',
    ];

    protected $casts = [
        'open_in_new_tab' => 'boolean',
        'status' => 'boolean',
        'order' => 'integer',
    ];

    // Relationships

    public function parent()
    {
        return $this->belongsTo(MenuItem::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(MenuItem::class, 'parent_id')->orderBy('order');
    }

    public function activeChildren()
    {
        return $this->hasMany(MenuItem::class, 'parent_id')
            ->where('status', true)
            ->orderBy('order');
    }

    // Scopes

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopeRoot($query)
    {
        return $query->whereNull('parent_id');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

    // Static Methods

    /**
     * Get the full menu tree with caching for frontend
     */
    public static function getMenuTree()
    {
        return Cache::remember('menu_tree', 3600, function () {
            return self::root()
                ->active()
                ->ordered()
                ->with(['activeChildren' => function ($query) {
                    $query->orderBy('order');
                }])
                ->get();
        });
    }

    /**
     * Get all items as flat tree for admin (includes inactive)
     */
    public static function getAdminTree()
    {
        return self::root()
            ->ordered()
            ->with(['children' => function ($query) {
                $query->orderBy('order');
            }])
            ->get();
    }

    /**
     * Clear menu cache
     */
    public static function clearCache()
    {
        Cache::forget('menu_tree');
    }

    // Model Events

    protected static function booted()
    {
        static::saved(function () {
            self::clearCache();
        });

        static::deleted(function () {
            self::clearCache();
        });
    }

    // Helpers

    public function hasChildren(): bool
    {
        return $this->children()->count() > 0;
    }

    public function isRoot(): bool
    {
        return is_null($this->parent_id);
    }

    public function getDepthAttribute(): int
    {
        return $this->parent_id ? 1 : 0;
    }
}
