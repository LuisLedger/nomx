<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FunctionaryActivityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'project_id' => $this->faker->sentence,
            // 'law_id' => $this->faker->sentence,
            'description' => $this->faker->sentence,
            'url'         => $this->faker->url,
            'image_url'   => 'https://fakeimg.pl/400x400/?text=Activity',
        ];
    }
}
