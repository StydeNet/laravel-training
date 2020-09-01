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
     * @testdox A los posts sin autor se les asigna un autor predeterminado.
     */
    function posts_without_an_author_are_assigned_a_default_author()
    {
        $post = factory(Post::class)->create([
            'author_id' => null,
        ]);

        $this->assertInstanceOf(User::class, $post->author);
        $this->assertFalse($post->author->exists);
        $this->assertSame('Styde', $post->author->name);
    }

    /**
     * @test
     * @testdox Un post pertenece a muchas categorías (o un post tiene muchas categorías).
     */
    /** @test */
    function a_post_belongs_to_many_categories()
    {
        $post = factory(Post::class)->create();

        $eloquent = factory(Category::class)->create([
            'title' => 'Eloquent',
        ]);

        $laravel = factory(Category::class)->create([
            'title' => 'Laravel',
        ]);
        $php = factory(Category::class)->create([
            'title' => 'PHP',
        ]);

        $post->categories()->sync($eloquent);
        $post->addCategories($laravel, $php);

        $this->assertInstanceOf(BelongsToMany::class, $post->categories());
        $this->assertInstanceOf(Collection::class, $post->categories);

        $this->assertCount(3, $post->categories);

        $this->assertSame(['Eloquent', 'Laravel', 'PHP'], $post->categories->pluck('title')->all());
    }

    /**
     * @test
     * @testdox Obtiene el atributo 'featured' como booleano.
     */
    function gets_the_featured_attribute_as_boolean()
    {
        $post = factory(Post::class)->create([
            'featured' => 1,
        ]);

        $this->assertTrue($post->featured);
    }

    /**
     * @test
     * @testdox Obtiene el campo 'published_at' como una instancia de Carbon.
     */
    function gets_the_published_at_field_as_a_carbon_instance()
    {
        $post = factory(Post::class)->create([
            'published_at' => '2020-08-31 12:00:00',
        ]);

        $this->assertInstanceOf(\Illuminate\Support\Carbon::class, $post->published_at);
        $this->assertSame('2020-08-31 12:00:00', $post->published_at->__toString());
    }

    /**
     * @test
     * @testdox Exporta el título, contenido, fecha y estado de publicación de los posts.
     */
    function exports_the_title_content_published_date_and_status_of_the_posts()
    {
        $post = factory(Post::class)->create([
            'title' => 'Título del post',
            'content' => 'Contenido del post',
            'published_at' => '2020-09-01 12:00:00',
        ]);

        $expected = [
            'title' => 'Título del post',
            'content' => 'Contenido del post',
            'published_at' => '01/09/2020 12:00',
            'is_published' => true,
        ];

        $this->assertSame($expected, $post->toArray());
        $this->assertSame(json_encode($expected), $post->toJson());
    }

    /**
     * @test
     * @testdox Exporta la información del autor del post.
     */
    function exports_the_posts_author_info()
    {
        $user = factory(User::class)->create([
            'first_name' => 'Duilio',
            'last_name' => 'Palacios',
            'email' => 'duilio@styde.net',
        ]);

        factory(Post::class)->create([
            'title' => 'Título del post',
            'content' => 'Contenido del post',
            'published_at' => '2020-09-01 12:00:00',
            'author_id' => $user->id,
        ]);

        $post = Post::with('author')->first();

        tap($post->toArray(), function ($postData) {
            $this->assertArrayHasKey('author', $postData);

            $expected = [
                'first_name' => 'Duilio',
                'last_name' => 'Palacios',
                'email' => 'duilio@styde.net',
            ];
            $this->assertSame($expected, $postData['author']);
        });
    }
}
