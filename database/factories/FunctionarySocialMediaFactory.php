<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FunctionarySocialMediaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $id = rand(0,3);
        $socials = [
            'Facebook',
            'Twitter',
            'Instagram',
            'Youtube'
        ];

        $icons = [
            'fa-facebook',
            'fa-twitter',
            'fa-instagram',
            'fa-youtube'
        ];

        return [
            'name_social_media' => $socials[$id],
            'icon'              => $icons[$id],
            'user'              => $this->faker->word,
            'url'               => $this->faker->url,
        ];
    }
}
