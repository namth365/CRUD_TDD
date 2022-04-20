<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach(range(1,50)as $index) {
            DB::table('tasks')->insert([
                'name' => Str::random(10),
                'price' => $faker->numberBetween ($min = 10, $max = 200),
                'image' => $faker->text(5).'abc.jpg',
            ]);
        }

    }
}
