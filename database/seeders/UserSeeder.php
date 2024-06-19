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

        $Admintupt_num = $faker->numberBetween($min = 1000, $max = 9000);
        $ResidentTuptnum = $faker->numberBetween($min = 1000, $max = 9000);
        $TechnicianTuptnum = $faker->numberBetween($min = 1000, $max = 9000);

       
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
            'room' => "Room 1",
            'bed' => "A",
            // 'roomdetails' => 'RoomBed'
            'img_path' => "/storage/residents/resident.png",
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
            'img_path' => "/storage/residents/resident.png",

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
            'name' => 'Plumber',
            'email' => 'maintenance1@dormitory.com',
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
            'room' => "Room 1",
            'bed' => "A",
            'img_path' => "/storage/residents/resident.png",

            'status' => "Active"

        ]);

        User::create([
            'name' => 'Electrician',
            'email' => 'maintenance2@dormitory.com',
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
            'room' => "Room 1",
            'bed' => "A",
            'status' => "Active",
            'img_path' => "/storage/residents/resident.png"

        ]);

        User::create([
            'name' => 'Housekeeper',
            'email' => 'maintenance3@dormitory.com',
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
            'room' => "Room 1",
            'bed' => "A",
            'status' => "Active",
            'img_path' => "/storage/residents/resident.png"

        ]);
        
        User::create([
            'email' => 'steven@gmail.com',
            'password' => bcrypt("password"),
            'role' => 'Resident',
            'branch' => 'Dormitory',
            'type' => 'Student',

            'name' => 'Steven Strange',
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
            'img_path' => "/storage/residents/resident.png",
            'room' => "Room 1",
            'bed' => "A",
            'status' => "Applicant"
        ]);

        for ($i = 0; $i < 20; $i++) {
            $tupt_temp = 'TUPT-20-';
            $tupt_num = $faker->numberBetween($min = 1000, $max = 9000);
            User::create([
                'email' => $faker->email,
                'password' => bcrypt("password"),
                'role' => 'Resident',
                'branch' => 'Dormitory',
                'type' => $faker->randomElement(['Student', 'Faculty', 'Staff']),
                'name' => $faker->name,
                'course' => $faker->randomElement(['BSIT', 'BSCS', 'BSBA']),
                'year' => $faker->randomElement(['1st year', '2nd year', '3rd year', '4th year']),
                'birthdate' => $faker->dateTimeBetween($startDate = '-30 years', $endDate = '-20 years', $timezone = null),
                'age' => $faker->numberBetween(18, 30),
                'sex' => $faker->randomElement(['Male', 'Female']),
                'religion' => $faker->randomElement(['Roman Catholic', 'Protestant', 'Islam', 'Buddhism', 'Hinduism']),
                'civil_status' => $faker->randomElement(['Single', 'Married', 'Divorced', 'Widowed']),
                'address' => $faker->address(),
                'contactNumber' => $faker->phoneNumber(),
                'Tuptnum' => $tupt_temp."".$tupt_num,
                'img_path' => "/images/user.png",
                'status' => "Applicant",
            ]);
        }
      
    }
}