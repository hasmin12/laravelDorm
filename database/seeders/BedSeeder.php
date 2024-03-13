<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Dormitorybed;
use App\Models\Hostelbed;
use App\Models\User;
use Faker\Factory as faker;
class BedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $dormitory_users = User::where('branch', '=', 'Dormitory')->where('role', '=', 'Resident')->take(8)->get();
        $hostel_users = User::where('branch', '=', 'Hostel')->where('role', '=', 'Resident')->take(8)->get();
        

        foreach (range(1, 8) as $index) {
            
            $bed1 = Dormitorybed::create([
                'name' => 'A',
                'room_id' => $index,
                // 'user_id' => $dormitory_users[$index - 1]->id,
                // 'status' => "Occupied",

            ]);

            $bed2 = Dormitorybed::create([
                'name' => 'B',
                'room_id' => $index,
            ]);

            $bed3 = Dormitorybed::create([
                'name' => 'C',
                'room_id' => $index,
            ]);

            $bed4 = Dormitorybed::create([
                'name' => 'D',
                'room_id' => $index,
            ]);
        }
    }
}
