<?php

use App\Jobs\ProcessPost;
use App\Models\Post;

public function store(Request $request)
{
    $validatedData = $request->validate([
        'title' => 'required|string|max:255',
        'body' => 'required|string',
    ]);

    $post = Post::create($validatedData);

    // Dispatch the job
    ProcessPost::dispatch($post);

    return response()->json($post, 201);
}

