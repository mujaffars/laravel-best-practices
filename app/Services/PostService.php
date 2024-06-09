<?php

namespace App\Services;

use App\Models\Post;

class PostService
{
    /**
     * Create a new post.
     *
     * @param  array  $data
     * @return \App\Models\Post
     */
    public function createPost(array $data)
    {
        // Perform any business logic here
        $data['title'] .= " -- PHP";
        return Post::create($data);
    }

    /**
     * Update an existing post.
     *
     * @param  \App\Models\Post  $post
     * @param  array  $data
     * @return bool
     */
    public function updatePost(Post $post, array $data)
    {
        // Perform any business logic here
        return $post->update($data);
    }

    /**
     * Delete a post.
     *
     * @param  \App\Models\Post  $post
     * @return bool|null
     */
    public function deletePost(Post $post)
    {
        // Perform any business logic here
        return $post->delete();
    }
}
