<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as faker;

use App\Models\Dormitoryroom;
use App\Models\Hostelroom;
class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        foreach (range(1, 8) as $index) {
            $room =  'Room ' . $index;
  
            $roomHostel = Hostelroom::create([
                'name' => $room,
                'type' => $faker->randomElement($array = array ('Student', 'Faculty', 'Staff')),
                'category' => $faker->randomElement($array = array ('Male', 'Female')),
            ]);

            $roomDorm  = Dormitoryroom::create([
                'name' => $room,
                'type' => $faker->randomElement($array = array ('Student', 'Faculty', 'Staff')),
                'category' => $faker->randomElement($array = array ('Male', 'Female')),
            ]);  
        }
    }
}
