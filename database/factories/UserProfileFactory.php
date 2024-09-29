<?php

namespace Database\Factories;

use App\Models\UserProfile;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserProfileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserProfile::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $user_id = 1;
        return [
            'course' => $this->faker->word,
            'year' => $this->faker->numberBetween(1, 4),
            'birthdate' => $this->faker->date,
            'age' => $this->faker->numberBetween(18, 60),
            'religion' => $this->faker->word,
            'civil_status' => $this->faker->word,
            'address' => $this->faker->address,
            'contactNumber' => $this->faker->phoneNumber,
            'Tuptnum' => $this->faker->word,
            'contract' => $this->faker->word,
            'cor' => $this->faker->word,
            'validID' => $this->faker->word,
            'vaccineCard' => $this->faker->word,
            'applicationForm' => $this->faker->word,
            'laptop' => $this->faker->boolean,
            'electricfan' => $this->faker->boolean,
            'is_paid' => $this->faker->boolean,
            'is_scheduled' => $this->faker->boolean,

            'user_id' => $user_id++
        ];
    }
}
