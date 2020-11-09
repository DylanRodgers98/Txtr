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
            'user_id' => User::factory()->create()->id,
            'display_name' => $this->faker->name,
            'bio' => FactoryHelpers::possiblyNull($this->faker->realText),
            'location' => FactoryHelpers::possiblyNull($this->faker->city . ", " . $this->faker->country),
            'website_url' => FactoryHelpers::possiblyNull($this->faker->url),
            // faker->image() generates a real image in the /tmp directory, so using ->imageUrl() instead to save time and space
            'profile_img_path' => FactoryHelpers::possiblyNull($this->faker->imageUrl()),
            'banner_img_path' => FactoryHelpers::possiblyNull($this->faker->imageUrl())
        ];
    }
}
