<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FunctionarySocialMediaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name_social_media' => $this->faker->word,
            'icon'              => $this->faker->word,
            'user'              => $this->faker->word,
            'url'               => $this->faker->url,
        ];
    }
}
