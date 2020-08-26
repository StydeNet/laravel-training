<?php

use App\Post;
use App\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::first();

        $post = Post::create([
            'title' => 'Post en borrador',
            'content' => 'En este videotutorial...',
            'author_id' => $user->id,
            'published_at' => null,
        ]);

        $post = Post::create([
            'title' => 'Post publicado',
            'content' => 'En este videotutorial...',
            'author_id' => $user->id,
            'published_at' => now(),
        ]);

        $post = Post::create([
            'title' => 'Post destacado publicado',
            'content' => 'En este videotutorial...',
            'featured' => true,
            'author_id' => $user->id,
            'published_at' => now(),
        ]);

        $post = Post::create([
            'title' => 'Post destacado programado',
            'content' => 'En este videotutorial...',
            'featured' => true,
            'author_id' => $user->id,
            'published_at' => now()->addDay(),
        ]);
    }
}
