<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsletterController;
use App\Models\AboutPageSetting;
use App\Models\ContactPageSetting;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [HomeController::class, 'index']);

Route::get('/blog', [BlogController::class, 'index']);

Route::get('/about', function () {
    return Inertia::render('About/Index', [
        'pageData' => AboutPageSetting::getAboutPageData(),
    ]);
});

Route::get('/contact', function () {
    return Inertia::render('Contact/Index', [
        'pageData' => ContactPageSetting::getContactPageData(),
    ]);
});

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

Route::get('/api/search-blogs', [BlogController::class, 'search'])->name('api.search-blogs');

Route::get('/success-stories', function () {
    return Inertia::render('SuccessStories/Index');
});

// Blog detail page with SEO-friendly URLs: /category/blog-title
Route::get('/{category}/{slug}', [BlogController::class, 'show'])->where('category', '^(?!admin).*');
