<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DormitoryBed>
 */
class DormitoryBedFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'room_id' => $this->faker->numberBetween(1, 50),
            'user_id' => $this->faker->numberBetween(1, 50),
            'name' => $this->faker->word,
            'status' => $this->faker->randomElement(['Available', 'Occupied']),
        ];
    }
}
