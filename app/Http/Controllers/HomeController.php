<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\HomepageSetting;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        // Get homepage settings from database
        $homepageData = HomepageSetting::getHomepageData();
        // Get featured blogs for carousel (5 latest featured or published blogs)
        $carouselBlogs = Blog::with(['user', 'categories'])
            ->published()
            ->where(function ($query) {
                $query->where('is_featured', true)
                    ->orWhereNotNull('published_at');
            })
            ->orderBy('is_featured', 'desc')
            ->orderBy('published_at', 'desc')
            ->limit(5)
            ->get()
            ->map(function ($blog) {
                return [
                    'id' => $blog->id,
                    'title' => $blog->title,
                    'excerpt' => $blog->excerpt,
                    'category' => $blog->categories->first()->name ?? 'Uncategorized',
                    'date' => $blog->published_at->format('M d, Y'),
                    'author' => $blog->user->name,
                    'readTime' => $blog->read_time . ' min read',
                    'image' => $blog->featured_image ? asset('storage/' . $blog->featured_image) : 'https://images.unsplash.com/photo-1499750310107-5fef28a66643?w=800&q=80',
                    'slug' => $blog->slug,
                    'categorySlug' => $blog->categories->first()->slug ?? 'uncategorized',
                ];
            });

        // Get featured articles for grid section (6 latest featured or published blogs)
        $featuredArticles = Blog::with(['user', 'categories'])
            ->published()
            ->where(function ($query) {
                $query->where('is_featured', true)
                    ->orWhereNotNull('published_at');
            })
            ->orderBy('is_featured', 'desc')
            ->orderBy('published_at', 'desc')
            ->limit(6)
            ->get()
            ->map(function ($blog) {
                return [
                    'id' => $blog->id,
                    'title' => $blog->title,
                    'excerpt' => $blog->excerpt,
                    'category' => $blog->categories->first()->name ?? 'Uncategorized',
                    'date' => $blog->published_at->format('M d, Y'),
                    'author' => $blog->user->name,
                    'readTime' => $blog->read_time . ' min read',
                    'image' => $blog->featured_image ? asset('storage/' . $blog->featured_image) : 'https://images.unsplash.com/photo-1499750310107-5fef28a66643?w=800&q=80',
                    'slug' => $blog->slug,
                    'categorySlug' => $blog->categories->first()->slug ?? 'uncategorized',
                ];
            });

        return Inertia::render('Home/Index', [
            'homepageData' => $homepageData,
            'carouselBlogs' => $carouselBlogs,
            'featuredArticles' => $featuredArticles,
        ]);
    }
}
