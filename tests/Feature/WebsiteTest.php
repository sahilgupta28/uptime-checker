<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Faker\Factory as Faker;

class WebsiteTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->faker = Faker::create();
        $this->input = [
            'title' => $this->faker->unique()->name,
            'domain' => $this->faker->url,
            'description' => $this->faker->paragraph
        ];
    }

    public function testWebsiteCreate()
    {
        $response = $this->post('website', $this->input);
        $response->assertStatus(302);

        $input = $this->input;
        unset($input['description']);
        $response = $this->post('website', $this->input);
        $response->assertStatus(302);
    }
}
