<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\EloquentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

// Basic Routes

// Home route
Route::get('/', function () {
    return view('welcome');
});

// About route
Route::get('/about', function () {
    return view('about');
});

// Contact route
Route::get('/contact', function () {
    return view('contact');
});

// Define a route that uses a controller
Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{id}', [PostController::class, 'show']);
Route::post('/posts', [PostController::class, 'store']);
Route::put('/posts/{id}', [PostController::class, 'update']);
Route::delete('/posts/{id}', [PostController::class, 'destroy']);

// Named routes
Route::get('/user/profile', [UserController::class, 'showProfile'])->name('profile');
// You can generate a URL to the named route using the route() helper
$url = route('profile');

// Route Groupes
Route::prefix('admin')->group(function () {
    Route::get('/users', [AdminController::class, 'users']);
    Route::get('/settings', [AdminController::class, 'settings']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index']);
    Route::get('/account', [AdminController::class, 'index']);
});

Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function () {
    Route::resource('posts', 'PostController');
});
