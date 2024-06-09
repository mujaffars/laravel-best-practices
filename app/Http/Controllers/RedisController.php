<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class RedisController extends Controller
{
    public function getPopularPosts(Request $request)
    {
        $popularPosts = Cache::remember('popular_posts', 10, function () {
            echo '<div class="container mt-5">Running query to get data</div>';
            return Post::orderBy('title', 'desc')->take(5)->get();
        });

        return view('posts.popular', compact('popularPosts'));
    }
}
