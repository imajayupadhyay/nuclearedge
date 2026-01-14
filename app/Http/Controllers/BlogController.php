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

    public function show(Request $request, $categorySlug, $slug)
    {
        // Check if preview mode is requested
        $isPreview = $request->has('preview') && $request->preview === 'true';

        // Build query
        $query = Blog::with(['user', 'categories'])->where('slug', $slug);

        // If preview mode and user is authenticated admin, allow viewing draft
        if ($isPreview && auth()->check()) {
            // Allow viewing any blog (draft or published) for authenticated users
            $blog = $query->firstOrFail();
        } else {
            // Only show published blogs for public access
            $blog = $query->published()->firstOrFail();
        }

        // Verify category matches
        $hasCategory = $blog->categories->contains('slug', $categorySlug);
        if (!$hasCategory) {
            abort(404);
        }

        // Only increment view count for non-preview (published) views
        if (!$isPreview) {
            $blog->increment('view_count');
        }

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
            'date' => $blog->published_at ? $blog->published_at->format('M d, Y') : 'Draft',
            'status' => $blog->status,
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
            'isPreview' => $isPreview && $blog->status === 'draft',
        ]);
    }

    public function search(Request $request)
    {
        $query = $request->input('q', '');
        $limit = $request->input('limit', 5);

        if (empty($query)) {
            return response()->json(['results' => []]);
        }

        $blogs = Blog::with(['user', 'categories'])
            ->published()
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                    ->orWhere('excerpt', 'like', "%{$query}%")
                    ->orWhere('content', 'like', "%{$query}%");
            })
            ->latest('published_at')
            ->limit($limit)
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

        return response()->json(['results' => $blogs]);
    }
}
