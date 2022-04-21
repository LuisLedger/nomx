<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DelegationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'delegation_id' => strtoupper(uniqid()),
            'name'          => $this->faker->name,
            'short_name'    => $this->faker->randomLetter . $this->faker->randomLetter,
            'status'        => 1,
        ];
    }
}
