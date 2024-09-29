<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Complaint;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Complaint>
 */
class ComplaintFactory extends Factory
{
    protected $model = Complaint::class;

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
            'complaint_details' => $this->faker->paragraph,
            'status' => $this->faker->randomElement(['pending', 'reviewed', 'resolved']),
            'resolved_at' => $this->faker->optional()->dateTimeBetween('now', '+1 year'),
        ];
    }
}
