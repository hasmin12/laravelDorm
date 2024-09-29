<?php

namespace Database\Factories;

use App\Models\SleepLog;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SleepLogFactory extends Factory
{
    protected $model = SleepLog::class;

    public function definition()
    {
        $userIds = User::pluck('id')->toArray();
        return [
            'user_id' => $this->faker->randomElement($userIds),
            'sleep_date' => $this->faker->date(), // Updated to generate a date
        ];
    }
}
