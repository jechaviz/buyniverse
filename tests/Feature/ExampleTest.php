<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Buyniverse');
        $response->assertHeader('Content-Security-Policy', "default-src 'self'; object-src 'none'; frame-ancestors 'self'; base-uri 'self'");
    }
}
