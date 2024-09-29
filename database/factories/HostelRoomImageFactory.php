<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\HostelRoom;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HostelRoomImage>
 */
class HostelRoomImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $hostelIds = HostelRoom::pluck('id')->toArray();
        return [
            //
            'hostel_room_id' => $this->faker->randomElement($hostelIds),
            'image_path' => $this->faker->imageUrl(),
        ];
    }
}
