<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Maintenancelist;
use Faker\Factory as faker;
class MaintenanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $main1 = Maintenancelist::create([
            'name' => 'General Repairs',
            'description' => 'Repairing damaged furniture, such as chairs, desks, or beds.'
        ]);
        
        $main2 = Maintenancelist::create([
            'name' => 'Electrical Problems',
            'description' => 'Fixing power outlets that are not functioning.'
        ]); 

        $main3 = Maintenancelist::create([
            'name' => 'Environmental Concerns',
            'description' => 'Repairing water damage or addressing leaks that could lead to mold.'
        ]); 
    }
}
