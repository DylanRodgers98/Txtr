<?php

namespace Database\Factories;

use App\Models\User;
use App\Helpers;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    private const CHANCE_OF_VERIFIED_EMAIL = 90;

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'username' => $this->faker->unique()->userName,
            'email' => $this->faker->unique()->safeEmail,
            'password' => $this->faker->password,
            'email_verified_at' => Helpers::possiblyNull(now())
        ];
    }
}
