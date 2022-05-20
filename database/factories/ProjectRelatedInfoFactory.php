<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectRelatedInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'       => $this->faker->sentence,
            'description' => $this->faker->text(300),
            'url'         => $this->faker->url,
            'image_url'   => 'https://fakeimg.pl/400x400/?text=ProjectRelated',
        ];
    }
}
