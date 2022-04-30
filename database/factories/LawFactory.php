<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LawFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'law_name'        => $this->faker->sentence,
            'description'     => $this->faker->paragraph,
            'url_global_info' => $this->faker->url,
            'image_url'       => 'https://fakeimg.pl/400x400/?text=Ley',
            'status'          => 1,
        ];
    }
}
