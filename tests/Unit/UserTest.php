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
    function can_get_the_profile_associated_to_a_user()
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
     * @testdox A los usuarios sin perfil se les asigna un perfil predeterminado.
     */
    function users_without_profile_are_assigned_a_default_profile()
    {
        $user = factory(User::class)->create([
            'first_name' => 'Duilio',
            'last_name' => 'Palacios',
        ]);

        $this->assertInstanceOf(UserProfile::class, $user->profile);
        $this->assertFalse($user->profile->exists);
        $this->assertSame('Developer', $user->profile->job_title);
        $this->assertSame("https://styde.net/perfil/duilio-palacios", $user->profile->website);
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

    /**
     * @test
     * @testdox Obtiene los posts publicados de un usuario.
     */
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

    /**
     * @test
     * @testdox los correos electrónicos se almacenan en minúsculas.
     */
    function emails_are_stored_in_lowercase()
    {
        $user = factory(User::class)->create([
            'email' => 'DUILIO@STYDE.NET',
        ]);

        $this->assertSame('duilio@styde.net', $user->email);
    }

    /**
     * @test
     * @testdox Obtiene el nombre completo del usuario.
     */
    function gets_the_full_name_of_the_user()
    {
        $user = factory(User::class)->create([
            'first_name' => 'Duilio',
            'last_name' => 'Palacios',
        ]);

        $this->assertSame('Duilio Palacios', $user->full_name);
    }

    /** @test */
    function stores_configuration_options()
    {
        $this->markTestIncomplete();

        $user = factory(User::class)->create([
            'options' => [
                'language' => 'es',
                'theme' => 'dark',
            ],
        ]);

        $this->assertSame('es', $user->options['language']);
        $this->assertSame('dark', $user->options['theme']);
    }
}
