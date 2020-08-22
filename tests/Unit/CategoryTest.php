<?php

namespace Tests\Unit;

use App\Category;
use App\Post;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /**
     * @test
     * @testdox Una categoría tiene muchos posts.
     */
    function a_category_has_many_posts()
    {
        $category = factory(Category::class)->create();

        $firstPost = factory(Post::class)->create();
        $secondPost = factory(Post::class)->create();

        $category->posts()->attach($firstPost);
        $category->posts()->attach($secondPost);

        $this->assertInstanceOf(BelongsToMany::class, $category->posts());
        $this->assertInstanceOf(Collection::class, $category->posts);
        $this->assertCount(2, $category->posts);

        $posts = $category->posts->all();
        $this->assertTrue($posts[0]->is($firstPost));
        $this->assertTrue($posts[1]->is($secondPost));
    }
}
