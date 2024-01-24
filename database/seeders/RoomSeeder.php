<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as faker;

use App\Models\Dormitoryroom;
use App\Models\Hostelroom;
use App\Models\Hostelimage;

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
            $type = $faker->randomElement($array = array ('Single', 'Double', 'Triple', 'Quad'));
            if($type == "Single"){
                $pax = 1;
                $price = 500;
            }elseif($type == "Double"){
                $pax = 2;
                $price = 800;
            }elseif($type == "Triple"){
                $pax = 3;
                $price = 1000;
            }else{
                $pax = 4;
                $price = 1200;
            }
            $roomHostel = Hostelroom::create([
                'name' => $room,
                'description' => "Nice room",
                'type' => $type,
                'pax' => $pax,
                'price' => $price,
            ]);

            foreach (range(1, 4) as $index) {
                Hostelimage::create([
                    'room_id' => $roomHostel->id,
                    'path' => "/storage/hostel/hostelroom.png",
                ]);
            }

            $roomDorm  = Dormitoryroom::create([
                'name' => $room,
                'type' => $faker->randomElement($array = array ('Student', 'Faculty', 'Staff')),
                'category' => $faker->randomElement($array = array ('Male', 'Female')),
                'slot' => 3,
                'totalBeds' => 4,
            ]);  
        }
    }
}
