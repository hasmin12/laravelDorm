<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as faker;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $tupt_temp = 'TUPT-20-';
        $tupt_num = $faker->numberBetween($min = 1000, $max = 9000);
       
        User::create([
            'name' => 'Dormitory Admin',
            'email' => 'dormitory@admin.com',
            'password' => bcrypt("password"),
            'role' => 'Admin',
            'branch' => 'Dormitory',
            'Tuptnum' => $tupt_temp . "" . $tupt_num,
            'contacts' => $faker->phoneNumber(),
            'address' => $faker->address(),
            'sex' => $faker->randomElement($array = array ('Male', 'Female')), // 'b'
            'birthdate' => $faker-> dateTimeBetween($startDate = '-30 years', $endDate = '-20 years', $timezone = null),
            'type' => 'Admin',
            'roomdetails' => 'RoomBed'
        ]);

        User::create([
            'name' => 'Hostel Admin',
            'email' => 'hostel@admin.com',
            'password' => bcrypt("password"),
            'role' => 'Admin',
            'branch' => 'Hostel',
            'Tuptnum' => $tupt_temp . "" . $tupt_num,
            'contacts' => $faker->phoneNumber(),
            'address' => $faker->address(),
            'sex' => $faker->randomElement($array = array ('Male', 'Female')), // 'b'
            'birthdate' => $faker-> dateTimeBetween($startDate = '-30 years', $endDate = '-20 years', $timezone = null),
            'type' => 'Admin',
            'roomdetails' => 'Room'
        ]);

        // foreach (range(1, 5) as $index) {
        //     $first_name = $faker->firstName();
        //     $last_name = $faker->lastName();
        //     $cusname = $first_name . ' ' . $last_name;

        //     $user = User::create([
        //         'name' => $cusname,
        //         'email' => $faker->email(),
        //         'password' => bcrypt("password"),
        //         'role' => 'Resident',
        //         'branch' => 'Hostel',
        //         'Tuptnum' => $tupt_temp . "" . $tupt_num,
        //         'address' => $faker->address(),
        //         'sex' => $faker->randomElement($array = array ('Male', 'Female')), // 'b'
        //         'birthdate' => $faker-> dateTimeBetween($startDate = '-30 years', $endDate = '-20 years', $timezone = null),
        //         'contacts' => $faker->phoneNumber(),
        //         'type' => 'Student'
        //     ]);
        
        // }

        foreach (range(1, 5) as $index) {
            $first_name = $faker->firstName();
            $last_name = $faker->lastName();
            $cusname = $first_name . ' ' . $last_name;

            $user = User::create([
                'name' => $cusname,
                'email' => $faker->email(),
                'password' => bcrypt("password"),
                'role' => 'Resident',
                'branch' => 'Dormitory',
                'Tuptnum' => $tupt_temp . "" . $tupt_num,
                'address' => $faker->address(),
                'sex' => $faker->randomElement($array = array ('Male', 'Female')), // 'b'
                'birthdate' => $faker-> dateTimeBetween($startDate = '-30 years', $endDate = '-20 years', $timezone = null),
                'contacts' => $faker->phoneNumber(),
                'type' => 'Student',
                'roomdetails' => 'RoomBed'
                
            ]);
        
        }
        foreach (range(1, 5) as $index) {
            $first_name = $faker->firstName();
            $last_name = $faker->lastName();
            $cusname = $first_name . ' ' . $last_name;

            $user = User::create([
                'name' => $cusname,
                'email' => $faker->email(),
                'password' => bcrypt("password"),
                'role' => 'Resident',
                'branch' => 'Dormitory',
                'Tuptnum' => $tupt_temp . "" . $tupt_num,
                'address' => $faker->address(),
                'sex' => $faker->randomElement($array = array ('Male', 'Female')), // 'b'
                'birthdate' => $faker-> dateTimeBetween($startDate = '-30 years', $endDate = '-20 years', $timezone = null),
                'contacts' => $faker->phoneNumber(),
                'type' => "Faculty",
                'roomdetails' => 'RoomBed'

            ]);
        
        }

        foreach (range(1, 5) as $index) {
            $first_name = $faker->firstName();
            $last_name = $faker->lastName();
            $cusname = $first_name . ' ' . $last_name;

            $user = User::create([
                'name' => $cusname,
                'email' => $faker->email(),
                'password' => bcrypt("password"),
                'role' => 'Resident',
                'branch' => 'Hostel',
                'Tuptnum' => $tupt_temp . "" . $tupt_num,
                'address' => $faker->address(),
                'sex' => $faker->randomElement($array = array ('Male', 'Female')), // 'b'
                'birthdate' => $faker-> dateTimeBetween($startDate = '-30 years', $endDate = '-20 years', $timezone = null),
                'contacts' => $faker->phoneNumber(),
                'type' => "Faculty",
                'roomdetails' => 'Room'

            ]);
        
        }

        foreach (range(1, 5) as $index) {
            $first_name = $faker->firstName();
            $last_name = $faker->lastName();
            $cusname = $first_name . ' ' . $last_name;

            $user = User::create([
                'name' => $cusname,
                'email' => $faker->email(),
                'password' => bcrypt("password"),
                'role' => 'Resident',
                'branch' => 'Dormitory',
                'Tuptnum' => $tupt_temp . "" . $tupt_num,
                'address' => $faker->address(),
                'sex' => $faker->randomElement($array = array ('Male', 'Female')), // 'b'
                'birthdate' => $faker-> dateTimeBetween($startDate = '-30 years', $endDate = '-20 years', $timezone = null),
                'contacts' => $faker->phoneNumber(),
                'type' => "Staff",
                'roomdetails' => 'RoomBed'

            ]);

            
        
        }

        foreach (range(1, 5) as $index) {
            $first_name = $faker->firstName();
            $last_name = $faker->lastName();
            $cusname = $first_name . ' ' . $last_name;

            $user = User::create([
                'name' => $cusname,
                'email' => $faker->email(),
                'password' => bcrypt("password"),
                'role' => 'Resident',
                'branch' => 'Hostel',
                'Tuptnum' => $tupt_temp . "" . $tupt_num,
                'address' => $faker->address(),
                'sex' => $faker->randomElement($array = array ('Male', 'Female')), // 'b'
                'birthdate' => $faker-> dateTimeBetween($startDate = '-30 years', $endDate = '-20 years', $timezone = null),
                'contacts' => $faker->phoneNumber(),
                'type' => "Staff",
                'roomdetails' => 'Room'

            ]);
        
        }
    }
}
