<?php

namespace Tests\Feature\Lessons;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ControllersTest extends TestCase
{
    /** @test */
    public function get_homepage()
    {
        $this->get('/')
            ->assertOk()
            ->assertViewIs('welcome');
    }

    /** @test */
    public function call_invokable_controller()
    {
        $this
            ->get('/health-check')
            ->assertOk();
    }

    /** @test */
    public function access_resource_controller_actions()
    {
        $this->get('/user')->assertOk()->assertSee('user index');

        $this->get('/user/create')->assertOk()->assertSee('create user');

        $this->post('/user')->assertOk()->assertSee('store user');

        $this->get('/user/1')->assertOk()->assertSee('show user');

        $this->get('/user/1/edit')->assertOk()->assertSee('edit user');

        $this->put('/user/1')->assertOk()->assertSee('update user');

        $this->delete('/user/1')->assertOk()->assertSee('delete user');
    }
}
