<?php

namespace Tests\Feature;

use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BlogRoutingTest extends TestCase
{
    use RefreshDatabase;

    public function test_published_blog_without_categories_is_accessible_via_uncategorized_route(): void
    {
        $user = User::factory()->create();

        $blog = Blog::create([
            'user_id' => $user->id,
            'title' => 'Test Blog',
            'slug' => 'test-blog',
            'excerpt' => 'Test excerpt',
            'content' => '<p>Test content</p>',
            'status' => 'published',
            'read_time' => 3,
            'published_at' => now(),
        ]);

        $response = $this->get("/uncategorized/{$blog->slug}");

        $response->assertOk();
    }

    public function test_published_blog_with_category_returns_404_for_wrong_category_slug(): void
    {
        $user = User::factory()->create();

        $category = Category::create([
            'name' => 'Technology',
            'slug' => 'technology',
            'status' => true,
            'order' => 1,
        ]);

        $blog = Blog::create([
            'user_id' => $user->id,
            'title' => 'Tech Blog',
            'slug' => 'tech-blog',
            'excerpt' => 'Tech excerpt',
            'content' => '<p>Tech content</p>',
            'status' => 'published',
            'read_time' => 4,
            'published_at' => now(),
        ]);

        $blog->categories()->attach($category->id);

        $response = $this->get("/business/{$blog->slug}");

        $response->assertNotFound();
    }
}
