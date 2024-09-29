<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'first_name' => 'System',
                'last_name' => 'Admin',
                'username' => 'systemadmin',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
                'phone_number' => '+12398190255',
                'sex' => 'Female',
                'type' => 'Faculty Member',

                'email_verified_at' => now(),
                'user_type' => 'admin',
                'status' => 'active',
                'image_path' => '/images/avatars/01.png',

            ],
            // [
            //     'first_name' => 'Demo',
            //     'last_name' => 'Admin',
            //     'username' => 'demoadmin',
            //     'email' => 'demo@example.com',
            //     'password' => bcrypt('password'),
            //     'phone_number' => '+12398190255',
            //     'email_verified_at' => now(),
            //     'user_type' => 'demo_admin',
            //     'image_path' => '/images/avatars/02.png',

            // ],
            [
                'first_name' => 'John',
                'last_name' => 'User',
                'username' => 'user',
                'branch' => 'Dormitory',
                'email' => 'user@example.com',
                'password' => bcrypt('password'),
                'phone_number' => '+12398190255',
                'sex' => 'Male',
                'type' => 'Student',
                'email_verified_at' => now(),
                'user_type' => 'user',
                'status' => 'pending',
                'image_path' => '/images/avatars/03.png',

            ],
            [
                'first_name' => 'House Keeper',
                'last_name' => 'User',
                'username' => 'House Keeper',
                'email' => 'housekeeper@example.com',
                'password' => bcrypt('password'),
                'maintenance' => 'House Keeper',
                'sex' => 'Male',
                'type' => 'Staff',
                'phone_number' => '+12398190255',
                'email_verified_at' => now(),
                'user_type' => 'maintenance user',
                'status' => 'active',
                'image_path' => '/images/avatars/04.png',

            ],
            [
                'first_name' => 'Electrician',
                'last_name' => 'User',
                'username' => 'Electrician',
                'email' => 'electrician@example.com',
                'maintenance' => 'Electrician',
                'sex' => 'Male',
                'type' => 'Staff',
                'password' => bcrypt('password'),
                'phone_number' => '+12398190255',
                'email_verified_at' => now(),
                'user_type' => 'maintenance user',
                'status' => 'active',
                'image_path' => '/images/avatars/05.png',

            ],
            [
                'first_name' => 'Plumber',
                'last_name' => 'User',
                'username' => 'Plumber',
                'email' => 'plumber@example.com',
                'password' => bcrypt('password'),
                'maintenance' => 'Plumber',
                'sex' => 'Male',
                'type' => 'Staff',
                'phone_number' => '+12398190255',
                'email_verified_at' => now(),
                'user_type' => 'maintenance user',
                'status' => 'active',
                'image_path' => '/images/avatars/avtar_1.png'
            ],
        ];
        foreach ($users as $key => $value) {
            $user = User::create($value);
            $user->assignRole($value['user_type']);
        }
    }
}
