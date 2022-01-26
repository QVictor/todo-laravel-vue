<?php

namespace Tests\Feature;

use App\Models\Desk;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeskTest extends TestCase
{
    /**
     * store desk
     *
     * @return void
     */
    public function test_store()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'application/json'])->postJson('/api/desk/store',
            [
                'name' => 'test_desk_name',
            ]);

        $response
            ->assertStatus(201)
            ->assertJson(['name' => 'test_desk_name']);
    }

    /**
     * index desk
     *
     * @return void
     */
    public function test_index()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'application/json'])->get('/api/desks');

        $response
            ->assertStatus(200)
            ->assertJsonStructure(
                [
                    '*' => [
                        'completed',
                        'completed_at',
                        'created_at',
                        'id',
                        'name',
                        'sort',
                        'tasks' => [
                            '*' => [
                                'completed',
                                'completed_at',
                                'created_at',
                                'id',
                                'name',
                                'sort'
                            ]
                        ],
                        'updated_at',
                    ]
                ]
            )
            ->assertJsonFragment(['name' => 'test_desk_name']);
    }

    /**
     * update desk
     *
     * @return void
     */
    public function test_update()
    {
        $user = $this->create_test_desk();

        $response = $this->put('/api/desk/' . $user->id,
            [
                'name' => 'test_desk_name_2',
                'id' => $user->id,
                'completed' => 0,
            ]
        );

        $response
            ->assertStatus(200)
            ->assertJson(['name' => 'test_desk_name_2']);
    }

    public function test_destroy()
    {

        $user = $this->create_test_desk();
        $response = $this->delete('/api/desk/' . $user->id);

        $response->assertStatus(200);
    }

    private function create_test_desk()
    {
        return Desk::create(
            [
                'name' => 'test_name',
                'sort' => 2,
                'completed' => 1,
            ]
        );
    }
}
