<?php

namespace Tests\Feature;

use App\Models\Desk;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{
    /**
     * store task
     *
     * @return void
     */
    public function test_store()
    {
        $response = $this->withHeaders([
            'Content-Type' => 'application/json'])->postJson('/api/task/store',
            [
                'name' => 'test_task_name',
            ]);

        $response
            ->assertStatus(201)
            ->assertJson(['name' => 'test_task_name']);
    }

    /**
     * update task
     *
     * @return void
     */
    public function test_update()
    {
        $desk = $this->create_test_desk();
        $task = $this->create_test_task($desk->id);

        $response = $this->put('/api/task/' . $task->id,
            [
                'name' => 'test_test_name_2',
                'sort' => 1,
                'desk_id' => $desk->id,
                'completed' => 0,
            ]
        );

        $response
            ->assertStatus(200);
    }

    public function test_destroy()
    {

        $desk = $this->create_test_desk();
        $task = $this->create_test_task($desk->id);
        $response = $this->delete('/api/task/' . $task->id);

        $response->assertStatus(200);
    }

    private function create_test_task($desk_id)
    {
        return Task::create(
            [
                'name' => 'test_name',
                'desk_id' => $desk_id,
                'sort' => 2,
                'completed' => 1,
            ]
        );
    }

    private function create_test_desk() {
        return Desk::create(
            [
                'name' => 'test_name',
                'sort' => 2,
                'completed' => 1,
            ]
        );
    }
}
