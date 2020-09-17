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
        $query = http_build_query(['search' => 'test']);
        $response = $this->get('/user?'.$query);

        $response->assertStatus(200);
        $response->assertViewIs('user.index');
        $response->assertViewHas('search', 'test');
    }

    /** @test */
    public function can_make_post_request_to_store_data(): void
    {
        $response = $this->post('/user', [
            'name' => 'Joe Jones',
            'email' => 'joe@mail.com',
            'password' => $password = Hash::make('password'),
            'password_confirmation' => $password,
        ]);

        $response->assertRedirect('/user');

        $this->assertDatabaseHas('users', ['email' => 'joe@mail.com']);
    }

    /** @test */
    public function can_validate_request_params(): void
    {
        $response = $this->post('/user');

        $response->assertSessionHasErrors(['name', 'email', 'password']);
    }

    /** @test */
    public function can_make_delete_requests(): void
    {
        $user = factory(User::class)->create();
        $this->assertDatabaseHas('users', ['id' => $user->id]);

        $response = $this->delete('/user/'.$user->id);

        $response->assertRedirect('/user');
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }
}
