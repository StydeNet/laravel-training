<?php

namespace Tests\Unit;

use App\Post;
use App\User;
use App\UserProfile;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @testdox Puede obtener el perfil de usuario asociado a un usuario.
     */
    function can_get_the_user_profile_associated_to_a_user()
    {
        $user = factory(User::class)->create();
        $userProfile = factory(UserProfile::class)->create([
            'website' => 'https://styde.net',
            'user_id' => $user->id,
        ]);

        $this->assertInstanceOf(UserProfile::class, $user->profile);
        $this->assertTrue($userProfile->is($user->profile));
        $this->assertSame('https://styde.net', $user->profile->website);
    }

    /**
     * @test
     * @testdox Un usuario tiene muchos posts.
     */
    function a_user_has_many_posts()
    {
        $user = factory(User::class)->create();
        $firstPost = factory(Post::class)->create([
            'author_id' => $user->id,
        ]);
        $secondPost = factory(Post::class)->create([
            'author_id' => $user->id,
        ]);

        $this->assertInstanceOf(HasMany::class, $user->posts());
        $this->assertInstanceOf(Collection::class, $user->posts);
        $this->assertCount(2, $user->posts);

        $posts = $user->posts->all();
        $this->assertTrue(is_array($posts));
        $this->assertTrue($posts[0]->is($firstPost));
        $this->assertTrue($posts[1]->is($secondPost));
    }

    /** @test */
    function gets_the_published_posts_of_a_user()
    {
        $user = factory(User::class)->create();

        $published = factory(Post::class)->create([
            'author_id' => $user->id,
            'published_at' => now(),
        ]);

        $draft = factory(Post::class)->create([
            'author_id' => $user->id,
            'published_at' => null,
        ]);

        $scheduled = factory(Post::class)->create([
            'author_id' => $user->id,
            'published_at' => now()->addDay(),
        ]);

        $this->assertInstanceOf(HasMany::class, $user->publishedPosts());
        $this->assertInstanceOf(Collection::class, $user->publishedPosts);
        $this->assertCount(1, $user->publishedPosts);
        $this->assertTrue($user->publishedPosts->first()->is($published));
    }
}
