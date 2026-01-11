<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home/Index', [
        'videoUrl' => asset('traf_homepage_loop_final-1080p.mp4'),
    ]);
});

Route::get('/blog', function () {
    return Inertia::render('Blog/Index');
});

Route::get('/about', function () {
    return Inertia::render('About/Index');
});

Route::get('/contact', function () {
    return Inertia::render('Contact/Index');
});

Route::get('/success-stories', function () {
    return Inertia::render('SuccessStories/Index');
});

// Blog detail page with SEO-friendly URLs: /category/blog-title
Route::get('/{category}/{slug}', function ($category, $slug) {
    // In a real app, fetch from database
    // For now, using dummy data
    $blogs = [
        'technology-the-future-of-ai-in-business' => [
            'id' => 1,
            'title' => 'The Future of AI in Business: Transforming Operations and Decision-Making',
            'excerpt' => 'Explore how artificial intelligence is revolutionizing business operations, from automation to predictive analytics, and what it means for the future.',
            'category' => 'Technology',
            'date' => 'Jan 5, 2026',
            'author' => 'Rajesh Goel',
            'readTime' => '8 min read',
            'image' => 'https://images.unsplash.com/photo-1677442136019-21780ecad995?w=800&q=80'
        ],
        'business-digital-transformation' => [
            'id' => 2,
            'title' => 'Digital Transformation: A Complete Guide for Traditional Industries',
            'excerpt' => 'Learn how legacy businesses can successfully navigate digital transformation, overcome challenges, and emerge stronger in the digital age.',
            'category' => 'Business',
            'date' => 'Jan 3, 2026',
            'author' => 'Priya Sharma',
            'readTime' => '12 min read',
            'image' => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=800&q=80'
        ],
        'technology-building-scalable-web-applications' => [
            'id' => 3,
            'title' => 'Building Scalable Web Applications: Best Practices for 2026',
            'excerpt' => 'Discover the latest architectural patterns, tools, and methodologies for building web applications that scale effortlessly.',
            'category' => 'Technology',
            'date' => 'Dec 28, 2025',
            'author' => 'Amit Kumar',
            'readTime' => '10 min read',
            'image' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=800&q=80'
        ],
    ];

    $key = strtolower($category) . '-' . $slug;

    if (!isset($blogs[$key])) {
        abort(404);
    }

    return Inertia::render('Blog/Detail', [
        'blog' => $blogs[$key]
    ]);
});
