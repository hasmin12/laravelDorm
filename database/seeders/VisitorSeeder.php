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
            ],
            [
                'parentName' => 'Jonathan Gorczany',
                'residentName' => 'Melisa Gorczany',
                'relationship' => 'Father',
            ],
            [
                'parentName' => 'Jessica Mayert',
                'residentName' => 'Macey Mayert',
                'relationship' => 'Mother',
            ],
            [
                'parentName' => 'David Murray',
                'residentName' => 'Kaitlin Murray',
                'relationship' => 'Father',
            ],
            [
                'parentName' => 'Sarah Hagenes',
                'residentName' => 'Ezekiel Hagenes',
                'relationship' => 'Mother',
            ],
            [
                'parentName' => 'Kimberly Bergnaum',
                'residentName' => 'Brendon Bergnaum',
                'relationship' => 'Mother',
            ],
            [
                'parentName' => 'Michael Farrell',
                'residentName' => 'Sarai Farrell',
                'relationship' => 'Father',
            ],
            [
                'parentName' => 'Jennifer West',
                'residentName' => 'Cristian West',
                'relationship' => 'Mother',
            ],
            [
                'parentName' => 'Nicholas Mayert',
                'residentName' => 'Vella Mayert',
                'relationship' => 'Father',
            ],
            [
                'parentName' => 'Patricia Turner',
                'residentName' => 'Jermain Turner',
                'relationship' => 'Mother',
            ],
            [
                'parentName' => 'Timothy Carter',
                'residentName' => 'Linnie Carter',
                'relationship' => 'Father',
            ],
            [
                'parentName' => 'Amanda Wisoky',
                'residentName' => 'Josie Wisoky',
                'relationship' => 'Mother',
            ],
            [
                'parentName' => 'Christopher Hegmann',
                'residentName' => 'Izabella Hegmann',
                'relationship' => 'Father',
            ],
        ];

        // Shuffle the array to randomize the order
        shuffle($residentParentRelationships);

        // Take the first 50 entries from the shuffled array
        $selectedEntries = array_slice($residentParentRelationships, 0, 50);

        foreach ($selectedEntries as $relation) {
            Visitor::create([
                'name' => $relation['parentName'],
                'phone' => $faker->phoneNumber,
                'visit_date' => $faker->dateTimeBetween('-1 year', '+1 year')->format('Y-m-d H:i:s'),
                'residentName' => $relation['residentName'],
                'relationship' => $relation['relationship'],
                'purpose' => $faker->sentence,
                'validId' => $faker->randomElement([true, false]),
            ]);
        }
    }
}
