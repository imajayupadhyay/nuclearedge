<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\FooterController;
use App\Http\Controllers\Admin\HomepageController;
use App\Http\Controllers\Admin\NewsletterController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware('guest')->group(function () {
        Route::get('/nuclearedge-secure-login', [AdminAuthController::class, 'showLogin'])->name('login');
        Route::post('/nuclearedge-secure-login', [AdminAuthController::class, 'login'])->name('login.post');
    });

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

        Route::resource('users', UserController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('blogs', BlogController::class);
        Route::post('/blogs/hero-settings', [BlogController::class, 'updateHeroSettings'])->name('blogs.hero-settings');
        Route::resource('contacts', ContactController::class)->only(['index', 'show', 'destroy']);
        Route::post('/contacts/{contact}/mark-read', [ContactController::class, 'markAsRead'])->name('contacts.mark-read');
        Route::post('/contacts/{contact}/mark-unread', [ContactController::class, 'markAsUnread'])->name('contacts.mark-unread');

        Route::resource('newsletters', NewsletterController::class)->only(['index', 'destroy']);

        // Menu Management
        Route::get('/menus', [MenuController::class, 'index'])->name('menus.index');
        Route::post('/menus', [MenuController::class, 'store'])->name('menus.store');
        Route::put('/menus/{menuItem}', [MenuController::class, 'update'])->name('menus.update');
        Route::delete('/menus/{menuItem}', [MenuController::class, 'destroy'])->name('menus.destroy');
        Route::post('/menus/reorder', [MenuController::class, 'reorder'])->name('menus.reorder');

        // Footer Settings
        Route::get('/footer', [FooterController::class, 'index'])->name('footer.index');
        Route::put('/footer', [FooterController::class, 'update'])->name('footer.update');

        // Homepage Management
        Route::get('/homepage', [HomepageController::class, 'index'])->name('homepage.index');
        Route::post('/homepage', [HomepageController::class, 'update'])->name('homepage.update');
    });
});
