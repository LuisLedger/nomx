<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PeriodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'start'       => $this->faker->word,
            'end'         => $this->faker->word,
            'start_month' => $this->faker->word,
            'start_year'  => $this->faker->word,
            'end_month'   => $this->faker->word,
            'end_year'    => $this->faker->word,
        ];
    }
}
