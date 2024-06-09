<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Events\PostCreated;
use App\Http\Requests\CreatePostRequest;

class ServiceController extends Controller
{
    protected $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(CreatePostRequest $request)
    {

        $post = $this->postService->createPost($request->all());

        // event(new PostCreated($validatedData));
        return response()->json($post, 201);
    }

    public function update(Request $request, Post $post)
    {
        // $this->authorize('update', $post);

        $validatedData = $request->validate([
            'title' => 'sometimes|string|max:255',
            'body' => 'sometimes|string',
        ]);

        $this->postService->updatePost($post, $validatedData);

        return response()->json($post);
    }

    public function destroy(Post $post)
    {
        $this->postService->deletePost($post);

        return response()->json(null, 204);
    }
}
