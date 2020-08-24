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
            'title' => 'Convenciones con Eloquent ORM',
            'content' => 'En este videotutorial...',
            'author_id' => $user->id,
        ]);

        $post = Post::create([
            'title' => 'Relaciones de muchos a muchos en Eloquent ORM',
            'content' => 'En este videotutorial...',
            'author_id' => $user->id,
        ]);
    }
}
