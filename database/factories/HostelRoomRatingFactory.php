<?php

namespace Database\Factories;

use App\Models\HostelRoomRating;
use App\Models\HostelRoom;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class HostelRoomRatingFactory extends Factory
{
    protected $model = HostelRoomRating::class;

    public function definition()
    {
        return [
            'hostel_room_id' => HostelRoom::inRandomOrder()->first()->id, // Get a random existing hostel room
            'user_id' => User::inRandomOrder()->first()->id, // Get a random existing user
            'rating' => $this->faker->numberBetween(1, 5),
            'review' => $this->faker->sentence(),
        ];
    }
}
