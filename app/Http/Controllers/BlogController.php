<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = Blog::with(['user', 'categories'])
            ->published()
            ->latest('published_at');

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('excerpt', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%");
            });
        }

        // Category filter
        if ($request->has('category') && $request->category && $request->category !== 'All') {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('slug', strtolower(str_replace(' ', '-', $request->category)));
            });
        }

        $blogs = $query->paginate(12);

        // Transform blogs to match frontend format
        $blogs->getCollection()->transform(function ($blog) {
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

        // Get all categories for filter
        $categories = Category::active()
            ->whereHas('blogs', function ($q) {
                $q->published();
            })
            ->withCount(['blogs' => function ($q) {
                $q->published();
            }])
            ->orderBy('name')
            ->get()
            ->map(function ($category) {
                return [
                    'name' => $category->name,
                    'slug' => $category->slug,
                    'count' => $category->blogs_count,
                ];
            });

        return Inertia::render('Blog/Index', [
            'blogs' => $blogs,
            'categories' => $categories,
            'filters' => [
                'search' => $request->search,
                'category' => $request->category,
            ],
        ]);
    }

    public function show($categorySlug, $slug)
    {
        // Find blog by slug
        $blog = Blog::with(['user', 'categories'])
            ->published()
            ->where('slug', $slug)
            ->firstOrFail();

        // Verify category matches
        $hasCategory = $blog->categories->contains('slug', $categorySlug);
        if (!$hasCategory) {
            abort(404);
        }

        // Increment view count
        $blog->increment('view_count');

        // Get related articles (same category, exclude current)
        $relatedArticles = Blog::with(['user', 'categories'])
            ->published()
            ->where('id', '!=', $blog->id)
            ->whereHas('categories', function ($q) use ($blog) {
                $q->whereIn('categories.id', $blog->categories->pluck('id'));
            })
            ->latest('published_at')
            ->limit(3)
            ->get()
            ->map(function ($relatedBlog) {
                return [
                    'id' => $relatedBlog->id,
                    'title' => $relatedBlog->title,
                    'excerpt' => $relatedBlog->excerpt,
                    'category' => $relatedBlog->categories->first()->name ?? 'Uncategorized',
                    'date' => $relatedBlog->published_at->format('M d, Y'),
                    'author' => $relatedBlog->user->name,
                    'readTime' => $relatedBlog->read_time . ' min read',
                    'image' => $relatedBlog->featured_image ? asset('storage/' . $relatedBlog->featured_image) : 'https://images.unsplash.com/photo-1499750310107-5fef28a66643?w=800&q=80',
                    'slug' => $relatedBlog->slug,
                    'categorySlug' => $relatedBlog->categories->first()->slug ?? 'uncategorized',
                ];
            });

        // Transform blog to match frontend format
        $blogData = [
            'id' => $blog->id,
            'title' => $blog->title,
            'excerpt' => $blog->excerpt,
            'content' => $blog->content,
            'category' => $blog->categories->first()->name ?? 'Uncategorized',
            'categorySlug' => $blog->categories->first()->slug ?? 'uncategorized',
            'date' => $blog->published_at->format('M d, Y'),
            'author' => $blog->user->name,
            'authorBio' => $blog->user->bio ?? 'Content creator at Nuclear Edge',
            'authorAvatar' => $blog->user->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($blog->user->name) . '&background=F97316&color=fff',
            'readTime' => $blog->read_time . ' min read',
            'image' => $blog->featured_image ? asset('storage/' . $blog->featured_image) : 'https://images.unsplash.com/photo-1499750310107-5fef28a66643?w=800&q=80',
            'slug' => $blog->slug,
            'viewCount' => $blog->view_count,
            'metaTitle' => $blog->meta_title ?? $blog->title,
            'metaDescription' => $blog->meta_description ?? $blog->excerpt,
            'metaKeywords' => $blog->meta_keywords ?? '',
        ];

        return Inertia::render('Blog/Detail', [
            'blog' => $blogData,
            'relatedArticles' => $relatedArticles,
        ]);
    }
}
