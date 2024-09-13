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
            'img_path' => '/img/admin.png',
            'status' => "Active"
        ]);
        
        // User::create([
        //     'email' => 'dormitory@resident.com',
        //     'password' => bcrypt("password"),
        //     'role' => 'Resident',
        //     'branch' => 'Dormitory',
        //     'type' => 'Student',

        //     'name' => 'Dormitory Resident',
        //     'course' => 'BSIT',
        //     'year' => '4th year',
        //     'birthdate' => $faker-> dateTimeBetween($startDate = '-30 years', $endDate = '-20 years', $timezone = null),
        //     'age' => '21',
        //     'sex' => $faker->randomElement($array = array ('Male', 'Female')), 
        //     'religion' => 'Islam',
        //     'civil_status' => 'Single',
        //     'room' => 1,
        //     'bed' => "A",
        //     'img_path' => '/img/student.png',

        //     'address' => $faker->address(),
        //     'contactNumber' => $faker->phoneNumber(),
        //     'Tuptnum' => $tupt_temp . "" . $tupt_num,
            
        //     'status' => "Active"

        // ]);

        User::create([
            'name' => 'Plumber',
            'email' => 'dormitory@maintenance1.com',
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
            'img_path' => '/img/plumber.png',

            'status' => "Active"

        ]);

        User::create([
            'name' => 'Electrician',
            'email' => 'dormitory@maintenance2.com',
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
            'img_path' => '/img/electrician.png'

        ]);

        User::create([
            'name' => 'Housekeeper',
            'email' => 'dormitory@maintenance3.com',
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
            'img_path' => '/img/housekeeping.png'

        ]);
        
        User::create([
            'email' => 'trishiacates.daga@tup.edu.ph',
            'password' => bcrypt("password"),
            'role' => 'Resident',
            'branch' => 'Dormitory',
            'type' => 'Student',

            'name' => 'Daga, Trishia Cates A.',
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
            'img_path' => '/img/student.png',
            'room' => "Room 1",
            'bed' => "A",
            'status' => "Applicant"
        ]);
        User::create([
            'email' => 'joanamae.untalan@tup.edu.ph',
            'password' => bcrypt("password"),
            'role' => 'Resident',
            'branch' => 'Dormitory',
            'type' => 'Student',

            'name' => 'Untalan, Joana Mae D.',
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
            'img_path' => '/img/student.png',
            'room' => "Room 1",
            'bed' => "A",
            'status' => "Applicant"
        ]);
        User::create([
            'email' => 'beacassandra.mayuga@tup.edu.ph ',
            'password' => bcrypt("password"),
            'role' => 'Resident',
            'branch' => 'Dormitory',
            'type' => 'Student',

            'name' => 'Mayuga, Bea Cassandra B.',
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
            'img_path' => '/img/student.png',
            'room' => "Room 1",
            'bed' => "A",
            'status' => "Applicant"
        ]);
        User::create([
            'email' => 'shaira.marasigan@tup.edu.ph',
            'password' => bcrypt("password"),
            'role' => 'Resident',
            'branch' => 'Dormitory',
            'type' => 'Student',

            'name' => 'Marasigan, Shaira',
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
            'img_path' => '/img/student.png',
            'room' => "Room 1",
            'bed' => "A",
            'status' => "Applicant"
        ]);
        User::create([
            'email' => 'abigail.aboniawan@tup.edu.ph',
            'password' => bcrypt("password"),
            'role' => 'Resident',
            'branch' => 'Dormitory',
            'type' => 'Student',

            'name' => 'Aboniawan, Abigail',
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
            'img_path' => '/img/student.png',
            'room' => "Room 1",
            'bed' => "A",
            'status' => "Applicant"
        ]);
        User::create([
            'email' => 'ariellejoy.francisco@tup.edu.ph',
            'password' => bcrypt("password"),
            'role' => 'Resident',
            'branch' => 'Dormitory',
            'type' => 'Student',

            'name' => 'Francisco, Aerielle Joy',
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
            'img_path' => '/img/student.png',
            'room' => "Room 1",
            'bed' => "A",
            'status' => "Applicant"
        ]);
        User::create([
            'email' => 'bettynakhayle.vargas@tup.edu.ph',
            'password' => bcrypt("password"),
            'role' => 'Resident',
            'branch' => 'Dormitory',
            'type' => 'Student',

            'name' => 'Vargas, Bettyna Khayle',
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
            'img_path' => '/img/student.png',
            'room' => "Room 1",
            'bed' => "A",
            'status' => "Applicant"
        ]);
        User::create([
            'email' => 'chemillerein.manuel@tup.edu.ph',
            'password' => bcrypt("password"),
            'role' => 'Resident',
            'branch' => 'Dormitory',
            'type' => 'Student',

            'name' => 'Manuel, Chemille Rein D.',
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
            'img_path' => '/img/student.png',
            'room' => "Room 1",
            'bed' => "A",
            'status' => "Applicant"
        ]);
        User::create([
            'email' => 'shanaiakassandra.ablan@tup.edu.ph',
            'password' => bcrypt("password"),
            'role' => 'Resident',
            'branch' => 'Dormitory',
            'type' => 'Student',

            'name' => 'Ablan, Shanaia Kassandra L.',
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
            'img_path' => '/img/student.png',
            'room' => "Room 1",
            'bed' => "A",
            'status' => "Applicant"
        ]);
        User::create([
            'email' => 'andrea.dosado@tup.edu.ph',
            'password' => bcrypt("password"),
            'role' => 'Resident',
            'branch' => 'Dormitory',
            'type' => 'Student',

            'name' => 'Dosado, Andrea S.',
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
            'img_path' => '/img/student.png',
            'room' => "Room 1",
            'bed' => "A",
            'status' => "Applicant"
        ]);
        User::create([
            'email' => 'ivy.barasi@tup.edu.ph',
            'password' => bcrypt("password"),
            'role' => 'Resident',
            'branch' => 'Dormitory',
            'type' => 'Student',

            'name' => ' Barasi, Ivy L.',
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
            'img_path' => '/img/student.png',
            'room' => "Room 1",
            'bed' => "A",
            'status' => "Applicant"
        ]);
        User::create([
            'email' => 'janicalynmarie.castilion@tup.edu.ph',
            'password' => bcrypt("password"),
            'role' => 'Resident',
            'branch' => 'Dormitory',
            'type' => 'Student',

            'name' => 'Castillon, Janicalyn Marie D.',
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
            'img_path' => '/img/student.png',
            'room' => "Room 1",
            'bed' => "A",
            'status' => "Applicant"
        ]);
        User::create([
            'email' => 'ellasofiamarie.pasquin@tup.edu.ph',
            'password' => bcrypt("password"),
            'role' => 'Resident',
            'branch' => 'Dormitory',
            'type' => 'Student',

            'name' => 'Pasquin Ella Sofia Marie O.',
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
            'img_path' => '/img/student.png',
            'room' => "Room 1",
            'bed' => "A",
            'status' => "Applicant"
        ]);
        User::create([
            'email' => 'blessymae.espiritu@tup.edu.ph',
            'password' => bcrypt("password"),
            'role' => 'Resident',
            'branch' => 'Dormitory',
            'type' => 'Student',

            'name' => 'Espiritu, Blessy Mae R.',
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
            'img_path' => '/img/student.png',
            'room' => "Room 1",
            'bed' => "A",
            'status' => "Applicant"
        ]);
        User::create([
            'email' => 'leamae.lapaya@tup.edu.ph',
            'password' => bcrypt("password"),
            'role' => 'Resident',
            'branch' => 'Dormitory',
            'type' => 'Student',

            'name' => 'Lapaya, Lea Mae C.',
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
            'img_path' => '/img/student.png',
            'room' => "Room 1",
            'bed' => "A",
            'status' => "Applicant"
        ]);
        User::create([
            'email' => 'lorna.arjona@tup.edu.ph',
            'password' => bcrypt("password"),
            'role' => 'Resident',
            'branch' => 'Dormitory',
            'type' => 'Student',

            'name' => 'Arjona, Lorna B.',
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
            'img_path' => '/img/student.png',
            'room' => "Room 1",
            'bed' => "A",
            'status' => "Applicant"
        ]);
        User::create([
            'email' => 'arlyn.juanir@tup.edu.ph',
            'password' => bcrypt("password"),
            'role' => 'Resident',
            'branch' => 'Dormitory',
            'type' => 'Student',

            'name' => 'Juanir, Arlyn L.',
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
            'img_path' => '/img/student.png',
            'room' => "Room 1",
            'bed' => "A",
            'status' => "Applicant"
        ]);
        User::create([
            'email' => 'elaine.taruc@tup.edu.ph',
            'password' => bcrypt("password"),
            'role' => 'Resident',
            'branch' => 'Dormitory',
            'type' => 'Student',

            'name' => 'Taruc, Elaine G.',
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
            'img_path' => '/img/student.png',
            'room' => "Room 1",
            'bed' => "A",
            'status' => "Applicant"
        ]);
        User::create([
            'email' => 'angel.ventura@tup.edu.ph',
            'password' => bcrypt("password"),
            'role' => 'Resident',
            'branch' => 'Dormitory',
            'type' => 'Student',

            'name' => ' Ventura, Angel',
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
            'img_path' => '/img/student.png',
            'room' => "Room 1",
            'bed' => "A",
            'status' => "Applicant"
        ]);
        User::create([
            'email' => 'divinamaris.mande@tup.edu.ph',
            'password' => bcrypt("password"),
            'role' => 'Resident',
            'branch' => 'Dormitory',
            'type' => 'Student',

            'name' => 'Mande, Divina Maris',
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
            'img_path' => '/img/student.png',
            'room' => "Room 1",
            'bed' => "A",
            'status' => "Applicant"
        ]);
        User::create([
            'email' => 'shekinah.baydal@tup.edu.ph',
            'password' => bcrypt("password"),
            'role' => 'Resident',
            'branch' => 'Dormitory',
            'type' => 'Student',

            'name' => 'Baydal, Shekinah M.',
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
            'img_path' => '/img/student.png',
            'room' => "Room 1",
            'bed' => "A",
            'status' => "Applicant"
        ]);
        User::create([
            'email' => 'jealorin.troyo@tup.edu.ph',
            'password' => bcrypt("password"),
            'role' => 'Resident',
            'branch' => 'Dormitory',
            'type' => 'Student',

            'name' => 'Troyo, Jea Lorin',
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
            'img_path' => '/img/student.png',
            'room' => "Room 1",
            'bed' => "A",
            'status' => "Applicant"
        ]);
        User::create([
            'email' => 'alexandra.venida@tup.edu.ph',
            'password' => bcrypt("password"),
            'role' => 'Resident',
            'branch' => 'Dormitory',
            'type' => 'Student',

            'name' => 'Venida, Alexandra E.',
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
            'img_path' => '/img/student.png',
            'room' => "Room 1",
            'bed' => "A",
            'status' => "Applicant"
        ]);
        User::create([
            'email' => 'lovelyann.venida@tup.edu.ph',
            'password' => bcrypt("password"),
            'role' => 'Resident',
            'branch' => 'Dormitory',
            'type' => 'Student',

            'name' => 'Venida, Lovely Ann E.',
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
            'img_path' => '/img/student.png',
            'room' => "Room 1",
            'bed' => "A",
            'status' => "Applicant"
        ]);
        User::create([
            'email' => 'mariahabyguelle.loreno@tup.edu.ph',
            'password' => bcrypt("password"),
            'role' => 'Resident',
            'branch' => 'Dormitory',
            'type' => 'Student',

            'name' => ' Loreno, Mariah Abyguelle',
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
            'img_path' => '/img/student.png',
            'room' => "Room 1",
            'bed' => "A",
            'status' => "Applicant"
        ]);
        User::create([
            'email' => 'angelamae.piquero@tup.edu.ph',
            'password' => bcrypt("password"),
            'role' => 'Resident',
            'branch' => 'Dormitory',
            'type' => 'Student',

            'name' => 'Piquero, Angela Mae',
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
            'img_path' => '/img/student.png',
            'room' => "Room 1",
            'bed' => "A",
            'status' => "Applicant"
        ]);
        User::create([
            'email' => 'alessandraivy.lazaro@tup.edu.ph',
            'password' => bcrypt("password"),
            'role' => 'Resident',
            'branch' => 'Dormitory',
            'type' => 'Student',

            'name' => 'Lazaro, Alyssándra Ivy B.',
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
            'img_path' => '/img/student.png',
            'room' => "Room 1",
            'bed' => "A",
            'status' => "Applicant"
        ]);
        User::create([
            'email' => 'gywnethselwynzoe.ortiz@tup.edu.ph',
            'password' => bcrypt("password"),
            'role' => 'Resident',
            'branch' => 'Dormitory',
            'type' => 'Student',

            'name' => 'Ortiz, Gwyneth Selwyn Zoe G.',
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
            'img_path' => '/img/student.png',
            'room' => "Room 1",
            'bed' => "A",
            'status' => "Applicant"
        ]);
        User::create([
            'email' => 'valerie.deofol@tup.edu.ph',
            'password' => bcrypt("password"),
            'role' => 'Resident',
            'branch' => 'Dormitory',
            'type' => 'Student',

            'name' => 'Deofol, Valerie M.',
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
            'img_path' => '/img/student.png',
            'room' => "Room 1",
            'bed' => "A",
            'status' => "Applicant"
        ]);
        User::create([
            'email' => 'marygrace.acal@tup.edu.ph',
            'password' => bcrypt("password"),
            'role' => 'Resident',
            'branch' => 'Dormitory',
            'type' => 'Student',

            'name' => 'Acal, Mary Grace A.',
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
            'img_path' => '/img/student.png',
            'room' => "Room 1",
            'bed' => "A",
            'status' => "Applicant"
        ]);
        User::create([
            'email' => 'keana.abregana@tup.edu.ph',
            'password' => bcrypt("password"),
            'role' => 'Resident',
            'branch' => 'Dormitory',
            'type' => 'Student',

            'name' => 'Abregana, Keana',
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
            'img_path' => '/img/student.png',
            'room' => "Room 1",
            'bed' => "A",
            'status' => "Applicant"
        ]);
        User::create([
            'email' => 'christinejane.caamic@tup.edu.ph',
            'password' => bcrypt("password"),
            'role' => 'Resident',
            'branch' => 'Dormitory',
            'type' => 'Student',

            'name' => 'Caamic, Christine Jane',
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
            'img_path' => '/img/student.png',
            'room' => "Room 1",
            'bed' => "A",
            'status' => "Applicant"
        ]);
        User::create([
            'email' => 'mikhaellagrace.catillo@tup.edu.ph',
            'password' => bcrypt("password"),
            'role' => 'Resident',
            'branch' => 'Dormitory',
            'type' => 'Student',

            'name' => ' Castillo, Mikhaela Grace L.',
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
            'img_path' => '/img/student.png',
            'room' => "Room 1",
            'bed' => "A",
            'status' => "Applicant"
        ]);
        User::create([
            'email' => 'biancajane.alzaga@tup.edu.ph',
            'password' => bcrypt("password"),
            'role' => 'Resident',
            'branch' => 'Dormitory',
            'type' => 'Student',

            'name' => 'Alzaga, Bianca Jane L.',
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
            'img_path' => '/img/student.png',
            'room' => "Room 1",
            'bed' => "A",
            'status' => "Applicant"
        ]);
        User::create([
            'email' => 'hannahshane.ampong@tup.edu.ph',
            'password' => bcrypt("password"),
            'role' => 'Resident',
            'branch' => 'Dormitory',
            'type' => 'Student',

            'name' => 'Ampong, Hannah Shane M.',
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
            'img_path' => '/img/student.png',
            'room' => "Room 1",
            'bed' => "A",
            'status' => "Applicant"
        ]);
        User::create([
            'email' => 'cassandrakim.noche@tup.edu.ph',
            'password' => bcrypt("password"),
            'role' => 'Resident',
            'branch' => 'Dormitory',
            'type' => 'Student',

            'name' => 'Noche, Casandra Kim M.',
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
            'img_path' => '/img/student.png',
            'room' => "Room 1",
            'bed' => "A",
            'status' => "Applicant"
        ]);
        User::create([
            'email' => 'rosemarie.misola@tup.edu.ph',
            'password' => bcrypt("password"),
            'role' => 'Resident',
            'branch' => 'Dormitory',
            'type' => 'Student',

            'name' => 'Misola, Rose Marie T',
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
            'img_path' => '/img/student.png',
            'room' => "Room 1",
            'bed' => "A",
            'status' => "Applicant"
        ]);
        User::create([
            'email' => 'alonicamae.manuel@tup.edu.ph',
            'password' => bcrypt("password"),
            'role' => 'Resident',
            'branch' => 'Dormitory',
            'type' => 'Student',

            'name' => 'Manuel, Alonica Mae.',
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
            'img_path' => '/img/student.png',
            'room' => "Room 1",
            'bed' => "A",
            'status' => "Applicant"
        ]);
      
        // for ($i = 0; $i < 20; $i++) {
        //     $tupt_temp = 'TUPT-20-';
        //     $tupt_num = $faker->numberBetween($min = 1000, $max = 9000);
        //     User::create([
        //         'email' => $faker->email,
        //         'password' => bcrypt("password"),
        //         'role' => 'Resident',
        //         'branch' => 'Dormitory',
        //         'type' => $faker->randomElement(['Student', 'Faculty', 'Staff']),
        //         'name' => $faker->name,
        //         'course' => $faker->randomElement(['BSIT', 'BSCS', 'BSBA']),
        //         'year' => $faker->randomElement(['1st year', '2nd year', '3rd year', '4th year']),
        //         'birthdate' => $faker->dateTimeBetween($startDate = '-30 years', $endDate = '-20 years', $timezone = null),
        //         'age' => $faker->numberBetween(18, 30),
        //         'sex' => $faker->randomElement(['Male', 'Female']),
        //         'religion' => $faker->randomElement(['Roman Catholic', 'Protestant', 'Islam', 'Buddhism', 'Hinduism']),
        //         'civil_status' => $faker->randomElement(['Single', 'Married', 'Divorced', 'Widowed']),
        //         'address' => $faker->address(),
        //         'contactNumber' => $faker->phoneNumber(),
        //         'Tuptnum' => $tupt_temp."".$tupt_num,
        //         'img_path' => "/images/user.png",
        //         'status' => "Applicant",
        //     ]);
        // }
      
    }
}