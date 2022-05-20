<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class GobermentEnterpriceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'        => $this->faker->company,
            'legal_name'  => $this->faker->catchPhrase,
            'description' => $this->faker->text(300),
            'url'         => $this->faker->url,
            'logo'        => 'https://fakeimg.pl/400x400/?text=Logo',
        ];
    }
}
