<?php

namespace Tests\Feature\Lessons;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RouteTypesTest extends TestCase
{
    /** @test */
    public function response_from_get_route()
    {
        $this->call('GET', '/user')
            ->assertOk()
            ->assertSee('GET response');
    }

    /** @test */
    public function response_from_post_route()
    {
        $this->call('POST', '/user')
            ->assertOk()
            ->assertSee('POST response');
    }

    /** @test */
    public function response_from_put_route()
    {
        $this->call('PUT', '/user/1')
            ->assertOk()
            ->assertSee('PUT response');
    }

    /** @test */
    public function response_from_patch_route()
    {
        $this->call('PATCH', '/user/1')
            ->assertOk()
            ->assertSee('PATCH response');
    }

    /** @test */
    public function response_from_options_route()
    {
        $this->call('OPTIONS', '/user')
            ->assertOk()
            ->assertSee('OPTIONS response');
    }

    /** @test */
    public function a_route_can_handle_two_different_types_of_requests()
    {
        $this->call('GET', '/home')
            ->assertOk()
            ->assertSee('MATCH response');

        $this->call('POST', '/home')
            ->assertOk()
            ->assertSee('MATCH response');

        $this->call('PUT', '/home')
            ->assertStatus(405);
    }

    /** @test */
    public function a_single_route_can_handle_any_method()
    {
        $verbs = ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'OPTIONS'];

        foreach ($verbs as $type) {
            $this->call($type, '/ping')
                ->assertOk()
                ->assertSee('Responding to ANY type of request');
        }
    }

    /** @test */
    public function a_route_can_redirect_to_another_url()
    {
        $this->get('/old-url')
            ->assertStatus(302)
            ->assertRedirect('/new-url');
    }

    /** @test */
    public function a_route_can_redirect_to_another_url_permanently()
    {
        $this->get('/removed-url')
            ->assertStatus(301)
            ->assertRedirect('/new-permanent-url');
    }

    /** @test */
    public function a_route_can_return_a_view_directly()
    {
        $this->get('/welcome')
            ->assertOk()
            ->assertViewIs('welcome');
    }
}
