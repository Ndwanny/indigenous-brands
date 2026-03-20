<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\Auth;
use App\Http\Controllers\BrandOwner;
use App\Http\Controllers\Public;
use Illuminate\Support\Facades\Route;

// ─── Public Routes ────────────────────────────────────────────────────────────
Route::get('/', [Public\HomeController::class, 'index'])->name('home');
Route::get('/about', [Public\AboutController::class, 'index'])->name('about');

Route::prefix('brands')->name('brands.')->group(function () {
    Route::get('/', [Public\BrandController::class, 'index'])->name('index');
    Route::get('/{slug}', [Public\BrandController::class, 'show'])->name('show');
});

Route::prefix('events')->name('events.')->group(function () {
    Route::get('/', [Public\EventController::class, 'index'])->name('index');
});

Route::prefix('blog')->name('blog.')->group(function () {
    Route::get('/', [Public\BlogController::class, 'index'])->name('index');
    Route::get('/{slug}', [Public\BlogController::class, 'show'])->name('show');
    Route::post('/{slug}/comments', [Public\BlogController::class, 'storeComment'])->name('comments.store');
});

Route::get('/get-involved', [Public\GetInvolvedController::class, 'index'])->name('get-involved');
Route::post('/get-involved', [Public\GetInvolvedController::class, 'store'])->name('get-involved.store');

Route::get('/contact', [Public\ContactController::class, 'index'])->name('contact');
Route::post('/contact', [Public\ContactController::class, 'store'])->name('contact.store');

// ─── Guest Auth Routes ─────────────────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login', [Auth\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [Auth\LoginController::class, 'login']);
    Route::get('/register', [Auth\RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [Auth\RegisterController::class, 'register']);
});

Route::post('/logout', [Auth\LoginController::class, 'logout'])->middleware('auth')->name('logout');

// ─── Brand Owner Routes ────────────────────────────────────────────────────────
Route::prefix('brand-owner')
    ->name('brand-owner.')
    ->middleware(['auth', 'is.brand.owner'])
    ->group(function () {
        Route::get('/dashboard', [BrandOwner\DashboardController::class, 'index'])->name('dashboard');

        Route::get('/brand/create', [BrandOwner\BrandProfileController::class, 'create'])->name('brand.create');
        Route::post('/brand', [BrandOwner\BrandProfileController::class, 'store'])->name('brand.store');
        Route::get('/brand/edit', [BrandOwner\BrandProfileController::class, 'edit'])->name('brand.edit');
        Route::put('/brand', [BrandOwner\BrandProfileController::class, 'update'])->name('brand.update');

        Route::middleware('has.approved.brand')->group(function () {
            Route::get('/posts/create', [BrandOwner\PostController::class, 'create'])->name('posts.create');
            Route::post('/posts', [BrandOwner\PostController::class, 'store'])->name('posts.store');
        });

        Route::get('/posts', [BrandOwner\PostController::class, 'index'])->name('posts.index');
        Route::get('/posts/{post}/edit', [BrandOwner\PostController::class, 'edit'])->name('posts.edit');
        Route::put('/posts/{post}', [BrandOwner\PostController::class, 'update'])->name('posts.update');
        Route::delete('/posts/{post}', [BrandOwner\PostController::class, 'destroy'])->name('posts.destroy');
    });

// ─── Admin Routes ──────────────────────────────────────────────────────────────
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'is.admin'])
    ->group(function () {
        Route::get('/dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard');

        Route::get('/users', [Admin\UserController::class, 'index'])->name('users.index');
        Route::patch('/users/{user}/role', [Admin\UserController::class, 'updateRole'])->name('users.update-role');
        Route::delete('/users/{user}', [Admin\UserController::class, 'destroy'])->name('users.destroy');

        Route::get('/brands', [Admin\BrandController::class, 'index'])->name('brands.index');
        Route::get('/brands/{brand}', [Admin\BrandController::class, 'show'])->name('brands.show');
        Route::patch('/brands/{brand}/approve', [Admin\BrandController::class, 'approve'])->name('brands.approve');
        Route::patch('/brands/{brand}/reject', [Admin\BrandController::class, 'reject'])->name('brands.reject');
        Route::patch('/brands/{brand}/feature', [Admin\BrandController::class, 'toggleFeatured'])->name('brands.feature');

        Route::get('/posts', [Admin\PostController::class, 'index'])->name('posts.index');
        Route::patch('/posts/{post}/status', [Admin\PostController::class, 'updateStatus'])->name('posts.status');
        Route::delete('/posts/{post}', [Admin\PostController::class, 'destroy'])->name('posts.destroy');

        Route::resource('/events', Admin\EventController::class)->except(['show']);

        Route::get('/categories', [Admin\CategoryController::class, 'index'])->name('categories.index');
        Route::post('/categories', [Admin\CategoryController::class, 'store'])->name('categories.store');
        Route::delete('/categories/{category}', [Admin\CategoryController::class, 'destroy'])->name('categories.destroy');

        Route::get('/comments', [Admin\CommentController::class, 'index'])->name('comments.index');
        Route::patch('/comments/{comment}/approve', [Admin\CommentController::class, 'approve'])->name('comments.approve');
        Route::delete('/comments/{comment}', [Admin\CommentController::class, 'destroy'])->name('comments.destroy');

        Route::get('/messages', [Admin\ContactMessageController::class, 'index'])->name('messages.index');
        Route::patch('/messages/{message}/read', [Admin\ContactMessageController::class, 'markRead'])->name('messages.read');
        Route::delete('/messages/{message}', [Admin\ContactMessageController::class, 'destroy'])->name('messages.destroy');

        Route::get('/volunteers', [Admin\VolunteerApplicationController::class, 'index'])->name('volunteers.index');
        Route::patch('/volunteers/{application}/status', [Admin\VolunteerApplicationController::class, 'updateStatus'])->name('volunteers.status');
    });
