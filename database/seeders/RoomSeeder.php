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
            $roomDorm  = Dormitoryroom::create([
                'name' => $room,
                'type' => $faker->randomElement($array = array ('Student', 'Faculty', 'Staff')),
                'category' => $faker->randomElement($array = array ('Male', 'Female')),
                'occupiedBeds' => 0,
                'totalBeds' => 4,
            ]);  
        }

        $roomHostel = Hostelroom::create([
            'name' => 'Single Room',
            'description' => 'Best Suit for 1 pax',
            'floorNum' => '1',
            'bedtype' => 'Single',
            'pax' => '1',  
            'price' => '500',
            'status' => 'Vacant',
            'img_path' => '/storage/hostel/room1.jpg',
            'wifi' => '0',
            'air_conditioning' => '0',
            'kettle' => '0', 
            'tv_with_cable' => '0',
            'hot_shower' => '0',
            'refrigerator' => '0',
            'kitchen' => '0',
            'hair_dryer' => '0',
        ]);

        $roomHostel = Hostelroom::create([
            'name' => 'Double Room',
            'description' => 'Comes with 1 double bed',
            'floorNum' => '1',
            'bedtype' => 'Double Bed',
            'pax' => '2',  
            'price' => '1000',
            'status' => 'Vacant',
            'img_path' => '/storage/hostel/room1.jpg',
            'wifi' => '0',
            'air_conditioning' => '0',
            'kettle' => '0', 
            'tv_with_cable' => '0',
            'hot_shower' => '0',
            'refrigerator' => '0',
            'kitchen' => '0',
            'hair_dryer' => '0',
        ]);

        $roomHostel = Hostelroom::create([
            'name' => 'Family Room',
            'description' => '29m2, accomodates 2 guests and 1-2 children',
            'floorNum' => '1',
            'bedtype' => '2 double bed',
            'pax' => '4',  
            'price' => '1500',
            'status' => 'Vacant',
            'img_path' => '/storage/hostel/room1.jpg',
            'wifi' => '0',
            'air_conditioning' => '0',
            'kettle' => '0', 
            'tv_with_cable' => '0',
            'hot_shower' => '0',
            'refrigerator' => '0',
            'kitchen' => '0',
            'hair_dryer' => '0',
        ]);

        $roomHostel = Hostelroom::create([
            'name' => 'Deluxe Room',
            'description' => '29m2, accomodates 2 guests',
            'floorNum' => '1',
            'bedtype' => 'King Size Bed',
            'pax' => '2',  
            'price' => '2000',
            'status' => 'Vacant',
            'img_path' => '/storage/hostel/room1.jpg',
            'wifi' => '0',
            'air_conditioning' => '0',
            'kettle' => '0', 
            'tv_with_cable' => '0',
            'hot_shower' => '0',
            'refrigerator' => '0',
            'kitchen' => '0',
            'hair_dryer' => '0',
        ]);

        $roomHostel = Hostelroom::create([
            'name' => 'Executive Room',
            'description' => '29m2, accomodates 2 guests',
            'floorNum' => '2',
            'bedtype' => 'King Size & Sofa Bed',
            'pax' => '2',  
            'price' => '3000',
            'status' => 'Vacant',
            'img_path' => '/storage/hostel/room1.jpg',
              'wifi' => '0',
            'air_conditioning' => '0',
            'kettle' => '0', 
            'tv_with_cable' => '0',
            'hot_shower' => '0',
            'refrigerator' => '0',
            'kitchen' => '0',
            'hair_dryer' => '0',
        ]);

        $roomHostel = Hostelroom::create([
            'name' => 'Double Room',
            'description' => 'Comes with 1 double bed',
            'floorNum' => '1',
            'bedtype' => 'Double Bed',
            'pax' => '2',  
            'price' => '1000',
            'status' => 'Vacant',
            'img_path' => '/storage/hostel/room1.jpg',
            'wifi' => '0',
            'air_conditioning' => '0',
            'kettle' => '0', 
            'tv_with_cable' => '0',
            'hot_shower' => '0',
            'refrigerator' => '0',
            'kitchen' => '0',
            'hair_dryer' => '0',
        ]);

        $roomHostel = Hostelroom::create([
          'name' => 'Single Room',
            'description' => '29m2, accomodates 2 guests',
            'floorNum' => '1',
            'bedtype' => 'Single',
            'pax' => '1',  
            'price' => '500',
            'status' => 'Vacant',
            'img_path' => '/storage/hostel/room1.jpg',
              'wifi' => '0',
            'air_conditioning' => '0',
            'kettle' => '0', 
            'tv_with_cable' => '0',
            'hot_shower' => '0',
            'refrigerator' => '0',
            'kitchen' => '0',
            'hair_dryer' => '0',
        ]);

        $roomHostel = Hostelroom::create([
            'name' => 'Executive Room',
            'description' => '29m2, accomodates 2 guests',
            'floorNum' => '2',
            'bedtype' => 'King Size & Sofa Bed',
            'pax' => '2',  
            'price' => '3000',
            'status' => 'Vacant',
            'img_path' => '/storage/hostel/room1.jpg',
              'wifi' => '0',
            'air_conditioning' => '0',
            'kettle' => '0', 
            'tv_with_cable' => '0',
            'hot_shower' => '0',
            'refrigerator' => '0',
            'kitchen' => '0',
            'hair_dryer' => '0',
        ]);
    }
}