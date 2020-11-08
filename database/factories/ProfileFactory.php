<?php

namespace Database\Factories;

use App\Models\Profile;
use App\Models\User;
use App\Helpers;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Profile::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory()->create()->id,
            'display_name' => $this->faker->name,
            'bio' => Helpers::possiblyNull($this->faker->realText),
            'location' => Helpers::possiblyNull($this->faker->city . ", " . $this->faker->country),
            'website_url' => Helpers::possiblyNull($this->faker->url)
        ];
    }
}
