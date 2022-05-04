<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResponseTest extends TestCase
{
    public function test_json_response() 
    {
        $response = $this->getJson('/api/home');

        // $response->dump();

        $response->assertStatus(200)
        ->assertJsonPath('data.page', 'This is the home page');
    }
}
