<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Desk;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DeskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $desk = new Desk();
        $countDesk = 3;
        foreach (range(0, $countDesk - 1) as $index) {
            $desk->create([
                    'sort' => $faker->unique()->numberBetween(0, $countDesk - 1),
                    'name' => $faker->realText(10),
                    'completed' => $faker->numberBetween(0,1),
                    'completed_at' => $faker->dateTimeBetween(
                        Carbon::today()->format('Y-m-d H:m:s'),
                        Carbon::today()->addMonths(6)->format('Y-m-d H:m:s')),
                ]
            );
        }
    }
}
