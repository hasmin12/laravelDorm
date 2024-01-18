<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Dormitorybed;
use App\Models\Hostelbed;
use Faker\Factory as faker;
class BedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        foreach (range(1, 8) as $index) {
            
            $bed1 = Dormitorybed::create([
                'name' => 'A',
                'room_id' => $index,
            ]);
            $room = $bed1->Dormitoryroom;
            $room->slot = $room->slot + 1;
            $room->totalBeds = $room->totalBeds + 1;

            // $room->occupied = $room->occupied + 1;
            $room->save();

            $bed2 = Dormitorybed::create([
                'name' => 'B',
                'room_id' => $index,
            ]);
            $room = $bed2->Dormitoryroom;
            $room->slot = $room->slot + 1;
            $room->totalBeds = $room->totalBeds + 1;
            $room->save();

            $bed3 = Dormitorybed::create([
                'name' => 'C',
                'room_id' => $index,
            ]);
            $room = $bed3->Dormitoryroom;
            $room->slot = $room->slot + 1;
            $room->totalBeds = $room->totalBeds + 1;
            $room->save();

            $bed4 = Dormitorybed::create([
                'name' => 'D',
                'room_id' => $index,
            ]);
            $room = $bed4->Dormitoryroom;
            $room->slot = $room->slot + 1;
            $room->totalBeds = $room->totalBeds + 1;
            $room->save();
        }

        foreach (range(1, 8) as $index) {
            
            $bed1 = Hostelbed::create([
                'name' => 'A',
                'room_id' => $index,
            ]);
            $room = $bed1->Hostelroom;
            $room->slot = $room->slot + 1;
            $room->totalBeds = $room->totalBeds + 1;
            $room->save();

            $bed2 = Hostelbed::create([
                'name' => 'B',
                'room_id' => $index,
            ]);
            $room = $bed2->Hostelroom;
            $room->slot = $room->slot + 1;
            $room->totalBeds = $room->totalBeds + 1;
            $room->save();

            $bed3 = Hostelbed::create([
                'name' => 'C',
                'room_id' => $index,
            ]);
            $room = $bed3->Hostelroom;
            $room->slot = $room->slot + 1;
            $room->totalBeds = $room->totalBeds + 1;
            $room->save();

            $bed4 = Hostelbed::create([
                'name' => 'D',
                'room_id' => $index,
            ]);
            $room = $bed4->Hostelroom;
            $room->slot = $room->slot + 1;
            $room->totalBeds = $room->totalBeds + 1;
            $room->save();
        }
    }
}
