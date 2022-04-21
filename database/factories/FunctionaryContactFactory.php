<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FunctionaryContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type'       => $this->faker->word,
            'first_name' => $this->faker->name,
            'last_name'  => $this->faker->lastName,
            'email'      => $this->faker->email,
            'phone'      => $this->faker->phoneNumber,
        ];
    }
}
