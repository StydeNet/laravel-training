<?php

namespace Tests\Unit;

use App\Category;
use App\Post;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Tests\TestCase;

class PostTest extends TestCase
{
    /**
     * @test
     * @testdox Un post pertenece a un autor.
     */
    function a_post_belongs_to_an_author()
    {
        $user = factory(User::class)->create();
        $post = factory(Post::class)->create([
            'author_id' => $user->id,
        ]);

        $this->assertInstanceOf(BelongsTo::class, $post->author());
        $this->assertInstanceOf(User::class, $post->author);
        $this->assertTrue($post->author->is($user));
    }

    /**
     * @test
     * @testdox Un post pertenece a muchas categorías (o un post tiene muchas categorías).
     */
    /** @test */
    function a_post_belongs_to_many_categories()
    {
        $post = factory(Post::class)->create();

        $laravel = factory(Category::class)->create([
            'title' => 'Laravel',
        ]);
        $php = factory(Category::class)->create([
            'title' => 'PHP',
        ]);

        $post->categories()->sync([$laravel->id, $php->id]);

        $this->assertInstanceOf(BelongsToMany::class, $post->categories());
        $this->assertInstanceOf(Collection::class, $post->categories);

        $this->assertCount(2, $post->categories);

        $this->assertSame(['Laravel', 'PHP'], $post->categories->pluck('title')->all());
    }
}
