<?php

namespace Database\Factories;

use App\Models\DormitoryRoom;
use App\Models\DormitoryBed;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DormitoryRoom>
 */
class DormitoryRoomFactory extends Factory
{
    protected $model = DormitoryRoom::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'totalBed' => 4,
            'occupiedBeds' => 0,
            // 'type' => $this->faker->randomElement(['Student', 'Faculty Member', 'Staff']),
            // 'category' => $this->faker->randomElement(['Male', 'Female']),
            'type' => 'Student',
            'category' => 'Male',
            'status' => $this->faker->randomElement(['available', 'unavailable']),
        ];
    }

    /**
     * Configure the factory to create related beds.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function configure()
    {
        return $this->afterCreating(function (DormitoryRoom $room) {
            // Create 4 beds for each dormitory room
            DormitoryBed::factory()->create([
                'room_id' => $room->id,
                'user_id' => null,
                'name' => 'Bed A', // Generates Bed A, Bed B, etc.
                'status' => 'available', // You can modify this based on your logic
            ]);

            DormitoryBed::factory()->create([
                'room_id' => $room->id,
                'user_id' => null,
                'name' => 'Bed B', // Generates Bed A, Bed B, etc.
                'status' => 'available', // You can modify this based on your logic
            ]);

            DormitoryBed::factory()->create([
                'room_id' => $room->id,
                'user_id' => null,
                'name' => 'Bed C', // Generates Bed A, Bed B, etc.
                'status' => 'available', // You can modify this based on your logic
            ]);

            DormitoryBed::factory()->create([
                'room_id' => $room->id,
                'user_id' => null,
                'name' => 'Bed D', // Generates Bed A, Bed B, etc.
                'status' => 'available', // You can modify this based on your logic
            ]);
        });
    }
}
