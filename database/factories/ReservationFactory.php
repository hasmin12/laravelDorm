<?php

namespace Database\Factories;

use App\Models\Reservation;
use App\Models\HostelRoom;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ReservationFactory extends Factory
{
    protected $model = Reservation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'hostel_room_id' => HostelRoom::factory(),
            'user_id' => User::factory(),
            'check_in_date' => $this->faker->dateTimeBetween('-5 months', '+1 month')->format('Y-m-d'),
            'check_out_date' => $this->faker->dateTimeBetween('+1 month', '+2 months')->format('Y-m-d'),
            // 'number_of_guests' => $this->faker->numberBetween(1, 4),
            'total_price' => $this->faker->numberBetween(50, 500),
            'status' => $this->faker->randomElement(['pending', 'confirmed', 'cancelled']),
        ];
    }
}
