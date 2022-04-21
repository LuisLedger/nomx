<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FunctionaryAssistanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'incidence_id'   => rand(1, 5),
            'incidence_date' => date('Y-m-d'),
            'incidence'      => $this->faker->paragraph,
        ];
    }
}
