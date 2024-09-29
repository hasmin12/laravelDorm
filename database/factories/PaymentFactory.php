<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
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
            'invoice' => $this->faker->unique()->word,
            'user_id' => $randomUserId, // Use the random user ID
            'amount' => $this->faker->randomFloat(2, 10, 1000),
            'laptop' => $this->faker->boolean(),
            'electricfan' => $this->faker->boolean(),
            'payment_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'status' => $this->faker->randomElement(['pending', 'paid']),
            'current_month' => now()->format('F Y'), // Add current_month here
        ];
    }
}
