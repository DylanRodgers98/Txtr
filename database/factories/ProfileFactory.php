<?php

namespace Database\Factories;

use App\Models\Profile;
use App\Models\User;
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
            'display_name' => $this->faker->name,
            'bio' => FactoryHelpers::possiblyNull($this->faker->realText(140)),
            'location' => FactoryHelpers::possiblyNull($this->faker->country),
            'website_url' => FactoryHelpers::possiblyNull($this->faker->url)
        ];
    }
}
