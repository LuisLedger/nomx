<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ComissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'              => $this->faker->name,
            'description'       => $this->faker->paragraph,
            'period_id'         => 1,
            'comission_type_id' => rand(1, 3),
        ];
    }
}
