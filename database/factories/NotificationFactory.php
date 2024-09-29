<?php
namespace Database\Factories;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class NotificationFactory extends Factory
{
    protected $model = Notification::class;

    public function definition()
    {
        $userIds = User::pluck('id')->toArray();
        return [
            'user_id' => $this->faker->randomElement($userIds),
            'title' => $this->faker->word(),
            'message' => $this->faker->sentence(),
            'is_read' => $this->faker->boolean(),
        ];
    }
}
