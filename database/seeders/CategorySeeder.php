<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Travel',
                'slug' => 'travel',
                'description' => 'Explore destinations, travel tips, and adventure stories from around the world.',
                'status' => true,
                'order' => 1,
                'meta_title' => 'Travel Blog - Destinations & Tips',
                'meta_description' => 'Discover amazing travel destinations, expert tips, and inspiring stories.',
                'children' => [
                    [
                        'name' => 'International Travel',
                        'slug' => 'international-travel',
                        'description' => 'International destinations and travel guides.',
                        'status' => true,
                        'order' => 1,
                    ],
                    [
                        'name' => 'Domestic Travel',
                        'slug' => 'domestic-travel',
                        'description' => 'Explore local destinations and hidden gems.',
                        'status' => true,
                        'order' => 2,
                    ],
                    [
                        'name' => 'Adventure Travel',
                        'slug' => 'adventure-travel',
                        'description' => 'Exciting adventures and outdoor activities.',
                        'status' => true,
                        'order' => 3,
                    ],
                    [
                        'name' => 'Budget Travel',
                        'slug' => 'budget-travel',
                        'description' => 'Travel tips and guides for budget-conscious travelers.',
                        'status' => true,
                        'order' => 4,
                    ],
                ],
            ],
            [
                'name' => 'Hotels',
                'slug' => 'hotels',
                'description' => 'Reviews and recommendations for hotels, resorts, and accommodations worldwide.',
                'status' => true,
                'order' => 2,
                'meta_title' => 'Hotel Reviews & Recommendations',
                'meta_description' => 'Find the best hotels, resorts, and accommodations for your next trip.',
                'children' => [
                    [
                        'name' => 'Luxury Hotels',
                        'slug' => 'luxury-hotels',
                        'description' => 'Premium and luxury hotel experiences.',
                        'status' => true,
                        'order' => 1,
                    ],
                    [
                        'name' => 'Boutique Hotels',
                        'slug' => 'boutique-hotels',
                        'description' => 'Unique boutique hotels with character and charm.',
                        'status' => true,
                        'order' => 2,
                    ],
                    [
                        'name' => 'Budget Hotels',
                        'slug' => 'budget-hotels',
                        'description' => 'Affordable hotel options without compromising comfort.',
                        'status' => true,
                        'order' => 3,
                    ],
                    [
                        'name' => 'Resorts & Spas',
                        'slug' => 'resorts-spas',
                        'description' => 'Relaxing resorts and spa destinations.',
                        'status' => true,
                        'order' => 4,
                    ],
                ],
            ],
            [
                'name' => 'Cafes',
                'slug' => 'cafes',
                'description' => 'Discover the best cafes, coffee shops, and cozy spots for coffee lovers.',
                'status' => true,
                'order' => 3,
                'meta_title' => 'Cafe Reviews & Coffee Culture',
                'meta_description' => 'Explore the finest cafes and coffee shops around the world.',
                'children' => [
                    [
                        'name' => 'Specialty Coffee',
                        'slug' => 'specialty-coffee',
                        'description' => 'Cafes serving artisanal and specialty coffee.',
                        'status' => true,
                        'order' => 1,
                    ],
                    [
                        'name' => 'Cozy Cafes',
                        'slug' => 'cozy-cafes',
                        'description' => 'Warm and inviting cafes perfect for relaxation.',
                        'status' => true,
                        'order' => 2,
                    ],
                    [
                        'name' => 'Work-Friendly Cafes',
                        'slug' => 'work-friendly-cafes',
                        'description' => 'Cafes with Wi-Fi and great ambiance for remote work.',
                        'status' => true,
                        'order' => 3,
                    ],
                    [
                        'name' => 'Bakery Cafes',
                        'slug' => 'bakery-cafes',
                        'description' => 'Cafes with delicious baked goods and pastries.',
                        'status' => true,
                        'order' => 4,
                    ],
                ],
            ],
        ];

        foreach ($categories as $categoryData) {
            $children = $categoryData['children'] ?? [];
            unset($categoryData['children']);

            $parent = Category::create($categoryData);

            foreach ($children as $childData) {
                $childData['parent_id'] = $parent->id;
                Category::create($childData);
            }
        }
    }
}
