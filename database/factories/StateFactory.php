<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'state_id'   => strtoupper(uniqid()),
            'name'       => $this->faker->name,
            'short_name' => $this->faker->randomLetter . $this->faker->randomLetter,
            'status'     => 1,
        ];
    }
}
