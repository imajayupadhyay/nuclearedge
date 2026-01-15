<?php

namespace Database\Seeders;

use App\Models\MenuItem;
use Illuminate\Database\Seeder;

class MenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing menu items
        MenuItem::truncate();

        // Main menu items
        $menuItems = [
            [
                'title' => 'Home',
                'url' => '/',
                'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6',
                'order' => 0,
                'status' => true,
            ],
            [
                'title' => 'About',
                'url' => '/about',
                'icon' => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
                'order' => 1,
                'status' => true,
            ],
            [
                'title' => 'Blog',
                'url' => '/blog',
                'icon' => 'M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z',
                'order' => 2,
                'status' => true,
                'children' => [
                    ['title' => 'Travel', 'url' => '/travel', 'order' => 0],
                    ['title' => 'Hotels', 'url' => '/hotels', 'order' => 1],
                    ['title' => 'Cafes', 'url' => '/cafes', 'order' => 2],
                    ['title' => 'Latest News', 'url' => '/latest-news', 'order' => 3],
                ],
            ],
            [
                'title' => 'Success Stories',
                'url' => '/success-stories',
                'icon' => 'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z',
                'order' => 3,
                'status' => true,
            ],
            [
                'title' => 'Contact',
                'url' => '/contact',
                'icon' => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z',
                'order' => 4,
                'status' => true,
            ],
        ];

        foreach ($menuItems as $item) {
            $children = $item['children'] ?? [];
            unset($item['children']);

            $parent = MenuItem::create($item);

            foreach ($children as $child) {
                MenuItem::create([
                    'title' => $child['title'],
                    'url' => $child['url'],
                    'parent_id' => $parent->id,
                    'order' => $child['order'],
                    'status' => true,
                ]);
            }
        }

        // Clear the cache after seeding
        MenuItem::clearCache();

        $this->command->info('Menu items seeded successfully!');
        $this->command->info('Created ' . MenuItem::count() . ' menu items.');
    }
}
