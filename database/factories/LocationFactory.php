<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'location_id' => uniqid(),
            'name'        => $this->faker->company,
            'short_name'  => $this->faker->company,
            'status'      => 1,
        ];
    }
}
