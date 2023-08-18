<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        // Check if the response status code is either 200 (OK) or 302 (Redirect)
        $response->assertStatus(200)
            ->assertStatus(302); // This line checks for a redirect (status code 302)
    }
}
