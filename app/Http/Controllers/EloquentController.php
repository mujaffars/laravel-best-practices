<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Comment;

class EloquentController extends Controller
{
    public function query(Request $request)
    {
        // $user = User::create([
        //     'name' => 'joseph Doe',
        //     'email' => 'joseph@example.com',
        //     'password' => bcrypt('password'), // Make sure to hash the password
        // ]);

        // Creating a comment for a user
        // $user = User::find(5);

        // $user->comments()->create([
        //     'body' => 'Comment Body',
        // ]);

        // Assigning a user to an existing comment
        // $comment = Comment::find(2);
        // $comment->user()->associate($user);
        // $comment->save();

        // $user = User::find(5);
        // $comments = $user->comments;
        // echo '<pre>';
        // print_r($user->toarray());
        // echo '</pre>';
        // exit;

        // Using Eloquent relationship
        $user = User::findOrFail(1);
        $comments = $user->comments;

        // Or using Eloquent query builder
        $comments = Comment::where('user_id', 1)->get();
        echo '<pre>';
        print_r($comments);
        echo '</pre>';
        exit;
    }

    public function eagerloading(Request $request)
    {

        // Without Eager Loading:
        $users = User::all();

        foreach ($users as $user) {
            // This will execute an additional query for each user to get their comments
            foreach ($user->comments as $comment) {
                echo $comment->body;
                echo '<br/>';
            }
        }

        // With Eager Loading:
        $users = User::with('comments')->get();

        foreach ($users as $user) {
            // Comments are already loaded, no additional queries are executed
            foreach ($user->comments as $comment) {
                echo $comment->body;
                echo '<br/>';
            }
        }

        exit;

        // Eager Loading Multiple Relationships
        // You can also eager load multiple relationships at once.

        $users = User::with(['comments', 'posts'])->get();
        foreach ($users as $user) {
            foreach ($user->comments as $comment) {
                echo $comment->body;
            }

            foreach ($user->posts as $post) {
                echo $post->title;
            }
        }

        // Eager Loading Nested Relationships
        // You can eager load nested relationships as well.
        $users = User::with('comments.replies')->get();

        foreach ($users as $user) {
            foreach ($user->comments as $comment) {
                echo $comment->body;

                foreach ($comment->replies as $reply) {
                    echo $reply->body;
                }
            }
        }

        // Conditional Eager Loading
        // You can conditionally eager load relationships using constraints.
        $users = User::with(['comments' => function ($query) {
            $query->where('created_at', '>=', now()->subMonth());
        }])->get();

        foreach ($users as $user) {
            foreach ($user->comments as $comment) {
                echo $comment->body;
            }
        }

        // Lazy Eager Loading
        // If you have already retrieved a collection of models and want to eager load relationships after the fact, you can use lazy eager loading.
        $users = User::all();

        // Later in the code
        $users->load('comments');

        foreach ($users as $user) {
            foreach ($user->comments as $comment) {
                echo $comment->body;
            }
        }
    }
}
