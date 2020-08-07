<?php

namespace Tests\Feature\Lessons;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutesTest extends TestCase
{
    /** @test */
    public function get_response_from_route_closure()
    {
        $this->get('/route-using-closure')
            ->assertOk()
            ->assertSee('Hello world!');
    }

    /** @test */
    public function register_route_using_controller_string()
    {
        $this->get('/route-using-controller-string')
            ->assertOk()
            ->assertSee('Hello world!');
    }

    /** @test */
    public function register_route_using_controller_class()
    {
        $this->get('/route-using-controller-class')
            ->assertOk()
            ->assertSee('Hello world!');
    }

    /** @test */
    public function register_route_using_single_action_controller()
    {
        $this->get('/route-using-single-action-controller')
            ->assertOk()
            ->assertSee('Hello world!');
    }
}
