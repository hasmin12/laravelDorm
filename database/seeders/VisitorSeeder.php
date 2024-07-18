<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Visitor;
use Faker\Factory as Faker;

class VisitorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();

        $residentParentRelationships = [
            [
                'parentName' => 'Martha Strange',
                'residentName' => 'Steven Strange',
                'relationship' => 'Mother',
                'phone' =>  '09323894542'  
            ],
            [
                'parentName' => 'Jonathan Gorczany',
                'residentName' => 'Melisa Gorczany',
                'relationship' => 'Father',
                'phone' => '09324782911',

            ],
            [
                'parentName' => 'Jessica Mayert',
                'residentName' => 'Macey Mayert',
                'relationship' => 'Mother',
                'phone' => '09438580796',
                
            ],
            [
                'parentName' => 'David Murray',
                'residentName' => 'Kaitlin Murray',
                'relationship' => 'Father',
                'phone' => '09448964501',

            ],
            [
                'parentName' => 'Sarah Hagenes',
                'residentName' => 'Ezekiel Hagenes',
                'relationship' => 'Mother',
                'phone' => '09434700331',

            ],
            [
                'parentName' => 'Kimberly Bergnaum',
                'residentName' => 'Brendon Bergnaum',
                'relationship' => 'Mother',
                'phone' => '09331359456',

            ],
            [
                'parentName' => 'Michael Farrell',
                'residentName' => 'Sarai Farrell',
                'relationship' => 'Father',
                'phone' => '09547883457',

            ],
            [
                'parentName' => 'Jennifer West',
                'residentName' => 'Cristian West',
                'relationship' => 'Mother',
                'phone' => '09489947218',

            ],
            [
                'parentName' => 'Nicholas Mayert',
                'residentName' => 'Vella Mayert',
                'relationship' => 'Father',
                'phone' => '09947727492',

            ],
            [
                'parentName' => 'Patricia Turner',
                'residentName' => 'Jermain Turner',
                'relationship' => 'Mother',
                'phone' => '09486884927',

            ],
            [
                'parentName' => 'Timothy Carter',
                'residentName' => 'Linnie Carter',
                'relationship' => 'Father',
                'phone' => '09547829384',

            ],
            [
                'parentName' => 'Amanda Wisoky',
                'residentName' => 'Josie Wisoky',
                'relationship' => 'Mother',
                'phone' => '09544819384',

            ],
            [
                'parentName' => 'Christopher Hegmann',
                'residentName' => 'Izabella Hegmann',
                'relationship' => 'Father',
                'phone' => '09919727462',

            ],
        ];

        // Shuffle the array to randomize the order
        shuffle($residentParentRelationships);

        // Take the first 50 entries from the shuffled array
        $selectedEntries = array_slice($residentParentRelationships, 0, 50);

        foreach ($selectedEntries as $relation) {
            Visitor::create([
                'name' => $relation['parentName'],
                'phone' => $relation['phone'],
                'visit_date' => $faker->dateTimeBetween('-1 year', '+1 year')->format('Y-m-d H:i:s'),
                'residentName' => $relation['residentName'],
                'relationship' => $relation['relationship'],
                'purpose' => $faker->sentence,
                'validId' => $faker->randomElement([true, false]),
            ]);
        }
    }
}
