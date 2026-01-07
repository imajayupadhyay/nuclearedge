<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home/Index', [
        // Placeholder tech video URL for demo purposes
        // Replace with your own video by placing it in public/videos/hero-background.mp4
        'videoUrl' => 'https://cdn.coverr.co/videos/coverr-particles-background-7947/1080p.mp4',
    ]);
});
