<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogPageSetting;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $blogs = Blog::query()
            ->with(['user', 'categories'])
            ->when($request->search, function ($query, $search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('excerpt', 'like', "%{$search}%");
            })
            ->when($request->status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->when($request->category, function ($query, $categoryId) {
                $query->whereHas('categories', function ($q) use ($categoryId) {
                    $q->where('categories.id', $categoryId);
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(15)
            ->withQueryString();

        $categories = Category::active()->ordered()->get();

        // Get hero settings
        $heroSettings = BlogPageSetting::all()->pluck('value', 'key')->toArray();

        return Inertia::render('Admin/Blogs/Index', [
            'blogs' => $blogs,
            'categories' => $categories,
            'filters' => $request->only(['search', 'status', 'category']),
            'heroSettings' => $heroSettings,
        ]);
    }

    /**
     * Update blog page hero settings
     */
    public function updateHeroSettings(Request $request)
    {
        $validated = $request->validate([
            'hero_label' => 'nullable|string|max:100',
            'hero_headline_line1' => 'nullable|string|max:255',
            'hero_headline_line2' => 'nullable|string|max:255',
            'hero_paragraph' => 'nullable|string|max:500',
        ]);

        $fields = [
            'hero_label',
            'hero_headline_line1',
            'hero_headline_line2',
            'hero_paragraph',
        ];

        foreach ($fields as $field) {
            if (array_key_exists($field, $validated)) {
                BlogPageSetting::updateOrCreate(
                    ['key' => $field],
                    [
                        'value' => $validated[$field],
                        'type' => 'text',
                        'group' => 'hero',
                        'label' => ucwords(str_replace('_', ' ', $field)),
                    ]
                );
            }
        }

        BlogPageSetting::clearCache();

        return back()->with('success', 'Blog page hero settings updated successfully.');
    }

    public function create()
    {
        $categories = Category::active()->ordered()->get();

        return Inertia::render('Admin/Blogs/Create', [
            'categories' => $categories,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blogs',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'read_time' => 'nullable|integer|min:1',
            'status' => 'required|in:draft,published',
            'is_featured' => 'nullable|boolean',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
            'published_at' => 'nullable|date',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        } else {
            $validated['slug'] = Str::slug($validated['slug']);
        }

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')
                ->store('blogs', 'public');
        }

        $validated['user_id'] = auth()->id();
        $validated['is_featured'] = $validated['is_featured'] ?? false;
        $validated['read_time'] = $validated['read_time'] ?? $this->calculateReadTime($validated['content']);

        if ($validated['status'] === 'published' && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        $categories = $validated['categories'] ?? [];
        unset($validated['categories']);

        $blog = Blog::create($validated);

        if (!empty($categories)) {
            $blog->categories()->attach($categories);
        }

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog post created successfully.');
    }

    public function edit(Blog $blog)
    {
        $categories = Category::active()->ordered()->get();

        return Inertia::render('Admin/Blogs/Edit', [
            'blog' => $blog->load(['user', 'categories']),
            'categories' => $categories,
        ]);
    }

    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('blogs')->ignore($blog->id)],
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'remove_image' => 'nullable|boolean',
            'read_time' => 'nullable|integer|min:1',
            'status' => 'required|in:draft,published',
            'is_featured' => 'nullable|boolean',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
            'published_at' => 'nullable|date',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        } else {
            $validated['slug'] = Str::slug($validated['slug']);
        }

        if ($request->boolean('remove_image') && $blog->featured_image) {
            Storage::disk('public')->delete($blog->featured_image);
            $validated['featured_image'] = null;
        }

        if ($request->hasFile('featured_image')) {
            if ($blog->featured_image) {
                Storage::disk('public')->delete($blog->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')
                ->store('blogs', 'public');
        }

        $validated['is_featured'] = $validated['is_featured'] ?? false;
        $validated['read_time'] = $validated['read_time'] ?? $this->calculateReadTime($validated['content']);

        if ($validated['status'] === 'published' && $blog->status === 'draft' && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        $categories = $validated['categories'] ?? [];
        unset($validated['categories']);
        unset($validated['remove_image']);

        $blog->update($validated);

        $blog->categories()->sync($categories);

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog post updated successfully.');
    }

    public function destroy(Blog $blog)
    {
        if ($blog->featured_image) {
            Storage::disk('public')->delete($blog->featured_image);
        }

        $blog->delete();

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog post deleted successfully.');
    }

    private function calculateReadTime($content)
    {
        $wordCount = str_word_count(strip_tags($content));
        $minutes = ceil($wordCount / 200);
        return max(1, $minutes);
    }
}
