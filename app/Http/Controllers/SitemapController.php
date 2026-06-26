<?php

namespace App\Http\Controllers;

use App\Models\Blog;

class SitemapController extends Controller
{
    /**
     * Generate a dynamic XML sitemap covering static pages,
     * published blog posts and active blog categories.
     */
    public function index()
    {
        $urls = [];

        // ── Static pages ──
        $staticPages = [
            ['path' => '/',                'changefreq' => 'weekly',  'priority' => '1.0'],
            ['path' => '/about',           'changefreq' => 'monthly', 'priority' => '0.8'],
            ['path' => '/success-stories', 'changefreq' => 'monthly', 'priority' => '0.8'],
            ['path' => '/clients',         'changefreq' => 'monthly', 'priority' => '0.7'],
            ['path' => '/blog',            'changefreq' => 'daily',   'priority' => '0.9'],
            ['path' => '/contact',         'changefreq' => 'yearly',  'priority' => '0.6'],
        ];

        foreach ($staticPages as $page) {
            $urls[] = [
                'loc'        => url($page['path']),
                'lastmod'    => now()->toAtomString(),
                'changefreq' => $page['changefreq'],
                'priority'   => $page['priority'],
            ];
        }

        // ── Published blog posts ──
        $blogs = Blog::with('categories')->published()->latest('published_at')->get();

        foreach ($blogs as $blog) {
            $categorySlug = $blog->categories->first()->slug ?? 'uncategorized';

            $urls[] = [
                'loc'        => url($categorySlug . '/' . $blog->slug),
                'lastmod'    => ($blog->updated_at ?? $blog->published_at)->toAtomString(),
                'changefreq' => 'weekly',
                'priority'   => '0.7',
            ];
        }

        $xml = view('sitemap', ['urls' => $urls])->render();

        return response($xml, 200)
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }
}
