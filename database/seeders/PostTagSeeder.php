<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Tag;

class PostTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get all posts and tags
        $posts = Post::all();
        $tags = Tag::all();

        // Ensure we have tags to attach
        if ($tags->isEmpty()) {
            $this->command->info('No tags found, skipping attaching tags to posts.');
            return;
        }

        // Attach random tags to each post
        foreach ($posts as $post) {
            // Attach between 1 and 3 tags to each post
            $post->tags()->attach(
                $tags->random(rand(1, 3))->pluck('id')->toArray()
            );
        }
    }
}
