<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProposalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'proposal_name'          => $this->faker->sentence,
            'description'            => $this->faker->paragraph,
            // 'level_id'               => $this->faker,
            // 'period_id'              => $this->faker,
            // 'promote_functionary_id' => $this->faker,
            // 'politic_group_id'       => $this->faker,
            // 'start_period_id'        => $this->faker,
            // 'execution_period_id'    => $this->faker,
            'url_global_info'        => $this->faker->url,
            'image_url'              => 'https://fakeimg.pl/400x400/?text=Promesas',
            'status'                 => 1,
        ];
    }
}
