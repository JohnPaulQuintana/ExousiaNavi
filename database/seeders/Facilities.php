<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;
class Facilities extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
         // Sample data to insert into the table
         $data = [];
         for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'facilities' => $faker->word, // Generate a random word
                'operation_time' => $faker->time('H:i A'), // Generate a random time in 12-hour format
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert the data into the table
        DB::table('eastwoods_facilities')->insert($data);
    }
}
