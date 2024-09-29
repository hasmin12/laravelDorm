<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HostelRoom>
 */
class HostelRoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'floorNumber' => $this->faker->numberBetween(1, 10),
            'beds' => $this->faker->numberBetween(1, 6),
            'price' => $this->faker->randomFloat(2, 10, 200),
            'pax' => $this->faker->numberBetween(1, 6),
            'status' => $this->faker->randomElement(['available', 'occupied', 'unavailable']),
        ];
    }
}
