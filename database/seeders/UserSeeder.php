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
        $Admintupt_num = $faker->numberBetween($min = 1000, $max = 9000);
        $ResidentTuptnum = $faker->numberBetween($min = 1000, $max = 9000);
        $TechnicianTuptnum = $faker->numberBetween($min = 1000, $max = 9000);
        $tupt_num = $faker->numberBetween($min = 1000, $max = 9000);

       
        User::create([
            'email' => 'dormitory@admin.com',
            'password' => bcrypt("password"),
            'role' => 'Admin',
            'branch' => 'Dormitory',
            'type' => 'Admin',

            'name' => 'Dormitory Admin',
            'course' => 'BSIT',
            'year' => '4th year',
            'birthdate' => $faker-> dateTimeBetween($startDate = '-30 years', $endDate = '-20 years', $timezone = null),
            'age' => '21',
            'sex' => $faker->randomElement($array = array ('Male', 'Female')), 
            'religion' => 'Roman Catholic',
            'civil_status' => 'Single',
            'address' => $faker->address(),
            'contactNumber' => $faker->phoneNumber(),
            'Tuptnum' => $tupt_temp . "" . $Admintupt_num,
            // 'roomdetails' => 'RoomBed'
            'status' => "Active"
        ]);
        
        User::create([
            'email' => 'dormitory@resident.com',
            'password' => bcrypt("password"),
            'role' => 'Resident',
            'branch' => 'Dormitory',
            'type' => 'Student',

            'name' => 'Dormitory Resident',
            'course' => 'BSIT',
            'year' => '4th year',
            'birthdate' => $faker-> dateTimeBetween($startDate = '-30 years', $endDate = '-20 years', $timezone = null),
            'age' => '21',
            'sex' => $faker->randomElement($array = array ('Male', 'Female')), 
            'religion' => 'Islam',
            'civil_status' => 'Single',
            'room' => 1,
            'bed' => "A",

            'address' => $faker->address(),
            'contactNumber' => $faker->phoneNumber(),
            'Tuptnum' => $tupt_temp . "" . $tupt_num,
            'status' => "Active"

        ]);

        // User::create([
        //     'name' => 'Hostel Admin',
        //     'email' => 'hostel@admin.com',
        //     'password' => bcrypt("password"),
        //     'role' => 'Admin',
        //     'branch' => 'Hostel',
        //     'Tuptnum' => $tupt_temp . "" . $tupt_num,
        //     'contacts' => $faker->phoneNumber(),
        //     'address' => $faker->address(),
        //     'sex' => $faker->randomElement($array = array ('Male', 'Female')), // 'b'
        //     'birthdate' => $faker-> dateTimeBetween($startDate = '-30 years', $endDate = '-20 years', $timezone = null),
        //     'type' => 'Admin',
        //     'roomdetails' => 'Room'
        // ]);

        User::create([
            'name' => 'Maintenance User1',
            'email' => 'dormitory@technician1.com',
            'password' => bcrypt("password"),
            'role' => 'Technician',
            'branch' => 'Dormitory',
            'Tuptnum' => $tupt_temp . "" . $TechnicianTuptnum,
            'contactNumber' => $faker->phoneNumber(),
            'address' => $faker->address(),
            'sex' => $faker->randomElement($array = array ('Male', 'Female')), // 'b'
            'birthdate' => $faker-> dateTimeBetween($startDate = '-30 years', $endDate = '-20 years', $timezone = null),
            'type' => 'Technician',
            'specialization' => 'General Repairs',
            // 'roomdetails' => 'RoomBed'
            'status' => "Active"

        ]);

        User::create([
            'name' => 'Maintenance User2',
            'email' => 'dormitory@technician2.com',
            'password' => bcrypt("password"),
            'role' => 'Technician',
            'branch' => 'Dormitory',
            'Tuptnum' => $tupt_temp . "" . $TechnicianTuptnum,
            'contactNumber' => $faker->phoneNumber(),
            'address' => $faker->address(),
            'sex' => $faker->randomElement($array = array ('Male', 'Female')), // 'b'
            'birthdate' => $faker-> dateTimeBetween($startDate = '-30 years', $endDate = '-20 years', $timezone = null),
            'type' => 'Technician',
            'specialization' => 'Appliance Repair',
            // 'roomdetails' => 'RoomBed'
            'status' => "Active"

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

        // foreach (range(1, 5) as $index) {
        //     $first_name = $faker->firstName();
        //     $last_name = $faker->lastName();
        //     $cusname = $first_name . ' ' . $last_name;
        //     $tupt_num = $faker->numberBetween($min = 1000, $max = 9000);

        //     $user = User::create([
        //         'name' => $cusname,
        //         'email' => $faker->email(),
        //         'password' => bcrypt("password"),
        //         'role' => 'Resident',
        //         'branch' => 'Dormitory',
        //         'Tuptnum' => $tupt_temp . "" . $tupt_num,
        //         'address' => $faker->address(),
        //         'sex' => $faker->randomElement($array = array ('Male', 'Female')), // 'b'
        //         'birthdate' => $faker-> dateTimeBetween($startDate = '-30 years', $endDate = '-20 years', $timezone = null),
        //         'contacts' => $faker->phoneNumber(),
        //         'type' => 'Student',
        //         'roomdetails' => 'RoomBed'
                
        //     ]);
        
        // }
        // foreach (range(1, 5) as $index) {
        //     $first_name = $faker->firstName();
        //     $last_name = $faker->lastName();
        //     $cusname = $first_name . ' ' . $last_name;
        //     $tupt_num = $faker->numberBetween($min = 1000, $max = 9000);

        //     $user = User::create([
        //         'name' => $cusname,
        //         'email' => $faker->email(),
        //         'password' => bcrypt("password"),
        //         'role' => 'Resident',
        //         'branch' => 'Dormitory',
        //         'Tuptnum' => $tupt_temp . "" . $tupt_num,
        //         'address' => $faker->address(),
        //         'sex' => $faker->randomElement($array = array ('Male', 'Female')), // 'b'
        //         'birthdate' => $faker-> dateTimeBetween($startDate = '-30 years', $endDate = '-20 years', $timezone = null),
        //         'contacts' => $faker->phoneNumber(),
        //         'type' => "Faculty",
        //         'roomdetails' => 'RoomBed'

        //     ]);
        
        // }

        // foreach (range(1, 5) as $index) {
        //     $first_name = $faker->firstName();
        //     $last_name = $faker->lastName();
        //     $cusname = $first_name . ' ' . $last_name;
        //     $tupt_num = $faker->numberBetween($min = 1000, $max = 9000);

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
        //         'type' => "Faculty",
        //         'roomdetails' => 'Room'

        //     ]);
        
        // }
    }
}