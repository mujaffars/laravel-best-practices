<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use App\Models\Post;
use App\Policies\PostPolicy;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //

        RateLimiter::for('dashboard_limit', function ($request) {
            return Limit::perMinute(5); // Adjust the limit as needed
        });
    }

    protected $policies = [
        Post::class => PostPolicy::class,
    ];
}
