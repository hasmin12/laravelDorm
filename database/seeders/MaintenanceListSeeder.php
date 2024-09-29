<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MaintenanceList;
use Faker\Factory as Faker;

class MaintenanceListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $maintenance1 = MaintenanceList::create([
            'name' => "Plumber",
            'image_path' => $faker->imageUrl()
        ]);

        $maintenance2 = MaintenanceList::create([
            'name' => "House Keeper",
            'image_path' => $faker->imageUrl()
        ]);

        $maintenance3 = MaintenanceList::create([
            'name' => "Electrician",
            'image_path' => $faker->imageUrl()
        ]);
    }
}
