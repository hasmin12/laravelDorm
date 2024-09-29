<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LaundrySchedule>
 */
class LaundryScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userIds = User::pluck('id')->toArray();

        return [
            'user_id' =>  $this->faker->randomElement($userIds),
            'scheduled_at' => $this->faker->dateTimeBetween('+1 days', '+1 month'),
        ];
    }
}
