<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Violation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Violation>
 */
class ViolationFactory extends Factory
{
    protected $model = Violation::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Fetch user IDs from the database
        $userIds = User::pluck('id')->toArray();

        return [
            'user_id' => $this->faker->randomElement($userIds),
            'violation_name' => $this->faker->word,

            'violation_type' => $this->faker->word,
            'details' => $this->faker->sentence,
            'penalty' => $this->faker->word,

            'status' => $this->faker->randomElement(['pending', 'resolved', 'dismissed']),
            'reported_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
