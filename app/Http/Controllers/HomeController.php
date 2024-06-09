<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;

class HomeController extends Controller
{
    //
    public function dashboard()
    {
        $post = Post::find(1);
        $tags = $post->tags;

        $tag = Tag::find(1);
        $posts = $tag->posts;

        echo '<pre>';
        print_r($tag->toarray());
        print_r($posts->toarray());
        echo '</pre>';
        exit;
        foreach ($tags as $tag) {
            echo $tag->name;
        }
    }

    public function limited()
    {
        echo 'here';
        exit;
    }
}
