<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Log;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Log>
 */
class LogFactory extends Factory
{
    protected $model = Log::class;

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
            // 'user_id' => $this->faker->randomElement($userIds),
            'user_id' => 2,
            'reason' => $this->faker->word,
            'gatepass' => $this->faker->word,
            'status' => $this->faker->randomElement(['Leave', 'Returned']),
            'log_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'date_of_leave' => $this->faker->optional()->dateTimeBetween('now', '+1 year'),
            'expected_return' => $this->faker->optional()->dateTimeBetween('now', '+1 year'),
            'returned_date' => $this->faker->optional()->dateTimeBetween('now', '+1 year'),
        ];
    }
}
