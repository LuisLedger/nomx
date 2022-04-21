<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FunctionaryVoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
            'vote_day' => date('Y-m-d'),
            // 'law_id' => $this->faker,
            // 'project_id' => $this->faker,
            'vote_type_id' => rand(1,3),
        ];
    }
}
