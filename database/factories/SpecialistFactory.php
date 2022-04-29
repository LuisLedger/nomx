<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SpecialistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $tt = $this->faker->word;
        $fb = $this->faker->word;
        $it = $this->faker->word;

        $state      = \App\Models\State::where('id', rand(1, 32))->first();
        $delegation = $state->delegations->first();
        $location   = $delegation->locations->first();

        return [
            'twitter_user'        => $tt,
            'facebook_user'       => $fb,
            'instagram_user'      => $it,
            'general_description' => $this->faker->sentence,
            'web_site'            => $this->faker->url,
            'state_id'            => $state->id,
            'delegation_id'       => $delegation->id,
            'location_id'         => $location->id,
        ];    
    }
}
