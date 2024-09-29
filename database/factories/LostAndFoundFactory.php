<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LostAndFound>
 */
class LostAndFoundFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fname = $this->faker->firstName;
        $lname = $this->faker->lastName;
        return [
            'owner' =>  $fname." ".$lname,
            'contact_number' => $this->faker->phoneNumber,

            'item_name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'image_path' => $this->faker->imageUrl(),

            'status' => $this->faker->randomElement(['lost', 'found']),
            'reported_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
