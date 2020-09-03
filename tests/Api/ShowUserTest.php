<?php

namespace Tests\Feature\Api;

use App\User;
use Tests\TestCase;

class ShowUserTest extends TestCase
{
    protected $admin;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = factory(User::class)->create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john.doe@example.com',
            'role' => 'admin',
        ]);

        $this->user = factory(User::class)->create([
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'email' => 'jane.doe@example.com',
        ]);
    }

    /**
     * @test
     * @testdox Los usuarios pueden ver los detalles de otro usuario.
     */
    function users_can_see_the_details_of_another_user()
    {
        $this->actingAs($this->user, 'api');

        $this->getJson("api/user/{$this->admin->id}")
            ->assertOk()
            ->assertExactJson([
                'data' => [
                    'first_name' => 'John',
                    'last_name' => 'Doe',
                ]
            ]);
    }

    /**
     * @test
     * @testdox Los administradores pueden ver los detalles de otro usuario (incluyendo su email).
     */
    function admins_can_see_the_details_of_another_user_including_the_email()
    {
        $this->actingAs($this->admin, 'api');

        $this->getJson("api/user/{$this->user->id}")
            ->assertOk()
            ->assertExactJson([
                'data' => [
                    'first_name' => 'Jane',
                    'last_name' => 'Doe',
                    'email' => 'jane.doe@example.com',
                ]
            ]);
    }

    /**
     * @test
     * @testdox Los usuarios anónimos no pueden ver la lista de usuarios.
     */
    function guests_cannot_see_the_details_of_any_user()
    {
        $this->getJson("api/user/{$this->user->id}")
            ->assertUnauthorized();
    }
}
