<?php

namespace Tests\Feature\Api;

use App\User;
use Tests\TestCase;

class ListUsersTest extends TestCase
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
     * @testdox Los usuarios pueden ver la lista de usuarios.
     */
    function users_can_see_the_list_of_users()
    {
        $this->markTestIncomplete();

        $this->actingAs($this->user, 'api');

        $this->getJson('api/users')
            ->assertOk()
            ->assertExactJson([
                [
                    'first_name' => 'John',
                    'last_name' => 'Doe',
                    'email' => 'john.doe@example.com',
                ],
                [
                    'first_name' => 'Jane',
                    'last_name' => 'Doe',
                    'email' => 'jane.doe@example.com',
                ],
            ]);
    }

    /**
     * @test
     * @testdox Los usuarios pueden ver la lista de usuarios envueltos en 'data'.
     */
    function users_can_see_the_list_of_users_wrapped_in_data()
    {
        $this->markTestIncomplete();

        $this->actingAs($this->user, 'api');

        $this->getJson('api/users')
            ->assertOk()
            ->assertExactJson([
                'data' => [
                    [
                        'first_name' => 'John',
                        'last_name' => 'Doe',
                    ],
                    [
                        'first_name' => 'Jane',
                        'last_name' => 'Doe',
                    ],
                ],
                'total' => 2,
            ]);
    }

    /**
     * @test
     * @testdox Los usuarios pueden ver la lista paginada de usuarios.
     */
    function users_can_see_the_paginated_list_of_users()
    {
        $this->markTestIncomplete();

        $this->actingAs($this->user, 'api');

        $this->getJson('api/paged-users')
            ->assertOk()
            ->assertExactJson([
                'data' => [
                    [
                        'first_name' => 'John',
                        'last_name' => 'Doe',
                    ],
                    [
                        'first_name' => 'Jane',
                        'last_name' => 'Doe',
                    ],
                ],
                'total' => 2,
                'links' => [
                    'first' => 'http://localhost/api/paged-users?page=1',
                    'last' => 'http://localhost/api/paged-users?page=1',
                    'prev' => null,
                    'next' => null,
                ],
                'meta' => [
                    'current_page' => 1,
                    'from' => 1,
                    'last_page' => 1,
                    'path' => 'http://localhost/api/paged-users',
                    'per_page' => 15,
                    'to' => 2,
                    'total' => 2,
                ],
            ]);
    }

    /**
     * @test
     * @testdox Los administradores pueden ver la lista de usuarios incluyendo sus emails.
     */
    function admins_can_see_the_list_of_users_including_emails()
    {
        $this->markTestIncomplete();

        $this->actingAs($this->admin, 'api');

        $this->getJson('api/users')
            ->assertOk()
            ->assertJson([
                'data' => [
                    [
                        'first_name' => 'John',
                        'last_name' => 'Doe',
                        'email' => 'john.doe@example.com',
                    ],
                    [
                        'first_name' => 'Jane',
                        'last_name' => 'Doe',
                        'email' => 'jane.doe@example.com',
                    ],
                ],
                'total' => 2,
            ]);
    }

    /**
     * @test
     * @testdox Los usuarios anónimos no pueden ver la lista de usuarios.
     */
    function guests_cannot_see_the_list_of_users()
    {
        $this->markTestIncomplete();

        $this->getJson('api/users')
            ->assertUnauthorized();
    }
}
