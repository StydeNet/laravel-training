<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class HttpRequestsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_make_get_requests(): void
    {
        $response = $this->get('/user');

        $response->assertStatus(200);
    }

    /** @test */
    public function can_send_params_using_get(): void
    {
        $query = http_build_query(['search' => 'my text search']);
        $response = $this->get('/user?'.$query);

        $response->assertStatus(200);
        $response->assertViewIs('user.index');
        $response->assertSee('my text search');
    }

    /** @test */
    public function can_make_post_request_to_store_data(): void
    {
        $response = $this->post(route('user.store'), [
            'name' => 'Joe Jones',
            'email' => 'joe@mail.com',
            'password' => $password = Hash::make('password'),
            'password_confirmation' => $password,
        ]);

        $response->assertRedirect(route('user.index'));

        $this->assertDatabaseHas('users', ['email' => 'joe@mail.com']);
    }

    /** @test */
    public function can_validate_request_params(): void
    {
        $response = $this->post(route('user.store'));

        $response->assertSessionHasErrors(['name', 'email', 'password']);
    }

    /** @test */
    public function can_make_delete_requests(): void
    {
        $user = factory(User::class)->create();
        $this->assertDatabaseHas('users', ['id' => $user->id]);

        $url = route('user.delete', ['user' => $user->id]);

        $response = $this->delete($url);

        $response->assertRedirect('/user');
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    /** @test */
    public function can_get_sored_data_in_the_view(): void
    {
        $user = factory(User::class)->create();

        $url = route('user.update', ['user' => $user->id]);

        $response = $this->get($url);

        $response->assertOk();
        $response->assertSee($user->name);
        $response->assertSee($user->email);
    }

    /** @test */
    public function can_update_users(): void
    {
        $user = factory(User::class)->create();

        $url = route('user.update', ['user' => $user->id]);

        $this->put($url, [
            'name' => 'joe',
            'email' => 'joe@mail.test',
        ]);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'joe',
            'email' => 'joe@mail.test',
        ]);
    }
}
