<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Visitor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Visitor>
 */
class VisitorFactory extends Factory
{
    protected $model = Visitor::class;

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
            'visitor_name' => $this->faker->name,
            'visitor_contact' => $this->faker->phoneNumber,
            'visit_purpose' => $this->faker->sentence,
            'visit_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
