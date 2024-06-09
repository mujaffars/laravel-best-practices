<?php

use App\Events\MessageSent;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\EloquentController;
use App\Http\Controllers\PusherController;
use App\Http\Controllers\RedisController;
use Illuminate\Support\Facades\Artisan;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/w2', function () {
    return view('welcome2');
});

Route::get('/w3', function () {
    return view('welcome3');
});

Route::get('/w4', function () {
    return view('welcome4');
});

Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

Route::get('/limited', [HomeController::class, 'limited'])->name('limited')
    ->middleware('throttle:dashboard_limit,1,1000');

Route::get('/posts/create', [ServiceController::class, 'create'])->name('posts.create');
Route::post('/posts', [ServiceController::class, 'store'])->name('posts.store');

Route::get('/pusher', function () {
    return view('pusher.pusher');
});

Route::get('/pusherbasic', function () {
    return view('pusher.pusherbasic');
});

// Eloquest Routes
Route::get('/query', [EloquentController::class, 'query']);
Route::get('/eagerloading', [EloquentController::class, 'eagerloading']);

// Caching Routes
Route::get('/getPopularPosts', [RedisController::class, 'getPopularPosts']);


// Middleware
Route::middleware(['custom'])->group(function () {
    Route::get('/protected-route', function () {
        return response()->json(['message' => 'This route is protected by custom middleware']);
    });
});

// Artisan command
Route::get('/makecontroller', function () {
    // Call the make:controller command
    $exitCode = Artisan::call('make:controller', [
        'name' => 'TestController'
    ]);

    // Check if the command was successful
    if ($exitCode === 0) {
        return response('Controller created successfully.', 200);
    } else {
        return response('Failed to create controller.', 500);
    }
});

Route::get('/send-message', function () {
    $message = 'Hello, this is a test message!';
    broadcast(new MessageSent($message));
    return 'Message sent!';
});

Route::get('/trigger-event', [PusherController::class, 'triggerPusherEvent']);
