<?php

namespace Database\Factories;

use Carbon\Carbon;
use Database\Seeders\DeskSeeder;
use Illuminate\Database\Eloquent\Factories\Factory;

class DeskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->realText(10),
            'sort' => $this->faker->unique->numberBetween(1, 3),
            'completed' => $this->faker->numberBetween(0,1),
            'completed_at' => $this->faker->dateTimeBetween(
                Carbon::today()->format('Y-m-d H:m:s'),
                Carbon::today()->addMonths(6)->format('Y-m-d H:m:s')),
        ];
    }
}
