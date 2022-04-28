<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'project_name'    => $this->faker->sentence,
            'description'     => $this->faker->paragraph,
            // 'level_id' => $this->faker->word,
            // 'promote_functionary_id' => $this->faker->word,
            // 'politic_group_id' => $this->faker->word,
            // 'start_period_id' => $this->faker->word,
            // 'execution_period_id' => $this->faker->word,
            'url_global_info' => $this->faker->url,
            'image_url'       => 'https://fakeimg.pl/400x400/?text=Proyecto',
            'status'          => 1,
        ];
    }
}
