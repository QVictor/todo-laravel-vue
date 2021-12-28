<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'application/json'])->postJson('/api/task/store', ['name' => 'test_name', 'desk_id' => '1']);

        $response
            ->assertStatus(201)
            ->assertJson(['name' => 'test_name']);
    }
}
