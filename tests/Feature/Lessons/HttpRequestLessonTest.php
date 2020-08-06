<?php

namespace Tests\Feature\Lessons;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HttpRequestLessonTest extends TestCase
{
    /** @test */
    public function access_request_method_using_dependency_injection()
    {
        $this->get('/request-using-di')
            ->assertOk()
            ->assertSee('GET');
    }

    /** @test */
    public function access_request_method_using_facade()
    {
        $this->get('/request-using-facade')
            ->assertOk()
            ->assertSee('GET');
    }

    /** @test */
    public function access_request_method_using_helper()
    {
        $this->get('/request-using-helper')
            ->assertOk()
            ->assertSee('GET');
    }

    /** @test */
    public function get_all_request_input()
    {
        $response = $this
            ->post('/get-all-request-input?source=facebook', [
                'name' => 'Jane Jones',
                'email' => 'jane@mail.com'
            ]);

        $response
            ->assertOk()
            ->assertJson([
            'source' => 'facebook',
            'name' => 'Jane Jones',
            'email' => 'jane@mail.com'
        ]);
    }

    /** @test */
    public function get_specific_input_from_request()
    {
        $response = $this
            ->post('/get-specific-input?source=facebook', [
                'name' => 'Jane Jones',
                'email' => 'jane@mail.com'
            ]);

        $response
            ->assertOk()
            ->assertSee('jane@mail.com');
    }

    /** @test */
    public function get_specific_value_from_request()
    {
        $response = $this
            ->post('/get-specific-value?source=facebook', [
                'name' => 'Jane Jones',
                'email' => 'jane@mail.com'
            ]);

        $response
            ->assertOk()
            ->assertSee('Jane Jones');
    }

    /** @test */
    public function get_specific_value_or_default_from_request()
    {
        $response = $this
            ->post('/get-specific-value-or-default?source=facebook', [
                'email' => 'jane@mail.com'
            ]);

        $response
            ->assertOk()
            ->assertSee('Undefined');
    }

    /** @test */
    public function get_specific_query_string_value_form_request()
    {
        $response = $this
            ->post('/get-specific-query-string-value?source=facebook', [
                'name' => 'Jane Jones',
                'email' => 'jane@mail.com'
            ]);

        $response
            ->assertOk()
            ->assertSee('facebook');
    }

    /** @test */
    public function get_only_some_values_from_request()
    {
        $response = $this
            ->post('/get-only?source=facebook', [
                'name' => 'Jane Jones',
                'email' => 'jane@mail.com'
            ]);

        $response
            ->assertOk()
            ->assertJson([
            'name' => 'Jane Jones',
            'email' => 'jane@mail.com'
        ]);
    }

    /** @test */
    public function get_all_input_except_specific_fields()
    {
        $response = $this
            ->post('/get-except?source=facebook', [
                'name' => 'Jane Jones',
                'email' => 'jane@mail.com'
            ]);

        $response
            ->assertOk()
            ->assertJson([
            'source' => 'facebook',
            'email' => 'jane@mail.com'
        ]);
    }

    /** @test */
    public function get_input_using_magic_properties()
    {
        $response = $this
            ->post('/get-using-magic-properties?source=facebook', [
                'name' => 'Jane Jones',
                'email' => 'jane@mail.com'
            ]);

        $response
            ->assertOk()
            ->assertSee('jane@mail.com');
    }

    /** @test */
    public function check_a_request_has_input()
    {
        $response = $this
            ->post('/check-input-present?source=facebook', [
                'name' => 'Jane Jones',
                'email' => 'jane@mail.com'
            ]);

        $response
            ->assertOk()
            ->assertSee('password and password_confirmation must be present.');
    }

    /** @test */
    public function check_request_has_any_of_specified_inputs()
    {
        $response = $this
            ->post('/check-any-input-present?source=facebook', [
                'name' => 'Jane Jones',
                'email' => 'jane@mail.com'
            ]);

        $response
            ->assertOk()
            ->assertSee('true');
    }

    /** @test */
    public function check_input_present_and_filled()
    {
        $response = $this
            ->post('/check-input-present-and-filled?source=facebook', [
                'name' => 'Jane Jones',
                'email' => 'jane@mail.com',
                'password' => ''
            ]);

        $response
            ->assertOk()
            ->assertSee('the password field is missing or empty');
    }

    /** @test */
    public function check_input_missing_in_the_request()
    {
        $response = $this
            ->post('/check-input-missing?source=facebook', [
                'name' => 'Jane Jones',
                'email' => 'jane@mail.com'
            ]);

        $response
            ->assertOk()
            ->assertSee('the password field is not present in the request');
    }
}
