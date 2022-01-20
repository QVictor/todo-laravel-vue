<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $task = new Task();
        $factory = $task::factory();
        for ($i = 0; $i < 20; $i++) {
            $factory->create();
        }
    }
}
