<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Faker\Factory as Faker;

class AuthTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->faker = Faker::create();
        $this->input = [
            'name' => $this->faker->unique()->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => 'secret',
            'password_confirmation' => 'secret'
        ];
    }

    public function testLoginPage()
    {
        $response = $this->get('login');

        $response->assertStatus(200);
        $response->assertSeeText('E-Mail');
        $response->assertSeeText('Enter your credentials below.');
    }

    public function testRegister()
    {
        $response = $this->get('register');
        $response->assertStatus(200);
        $response->assertSeeText('E-Mail');
        $response->assertSeeText('Enter your details to create a free account.');
    }

    public function testRegisterSuccess()
    {
        $response = $this->post('register', $this->input);

        $response->assertStatus(302);
    }

    public function testLoginSuccess()
    {
        $response = $this->get('login', $this->input);
        $response->assertStatus(200);
    }
}
