<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MaintenanceRequest>
 */
class MaintenanceRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userIds = User::pluck('id')->toArray();
        $randomUserId = $this->faker->randomElement($userIds);


        return [
            'user_id' => $randomUserId,
            'maintenance_user_id' => $this->faker->numberBetween(4, 6),
            'type' => $this->faker->word,
            'room_details' => $this->faker->word,

            'description' => $this->faker->sentence,
            'status' => $this->faker->randomElement(['pending', 'in_progress', 'completed', 'canceled']),
            'requested_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'image_path' => $this->faker->imageUrl(),
        ];
    }
}
