<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        $fname = $this->faker->firstName;
        $lname = $this->faker->lastName;
        $fullname = Str::lower($fname) . Str::lower($lname);
        $status = $this->faker->numberBetween(0, 2);
        $branch = $this->faker->randomElement(['Dormitory', 'Hostel']);
        $sex = $this->faker->randomElement(['Male', 'Female']);
        $type = $this->faker->randomElement(['Student', 'Faculty Member', 'Staff']);

        switch ($status) {
            case 1:
                $status = 'active';
                break;
            case 2:
                $status = 'inactive';
                break;
            default:
                $status = 'pending';
                break;
        }

        return [
            'username' => $fullname,
            'first_name' => $fname,
            'last_name' => $lname,
            'phone_number' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'image_path' => $this->faker->imageUrl(),
            'password' => bcrypt('password'),
            'branch' => $branch,
            'user_type' => 'user',
            'status' => 'pending',
            'sex' => $sex,
            'type' => $type
        ];
    }
}
