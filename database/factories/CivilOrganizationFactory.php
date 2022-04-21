<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CivilOrganizationFactory extends Factory
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

        $state = \App\Models\State::where('id', rand(1,32))->first();
        $delegation = $state->delegations->first();
        $location = $delegation->locations->first();

        return [
            'name' => $this->faker->name,
            'twitter_user' => $tt,
            'twitter_url' => 'https://www.twitter.com/'.$tt,
            'facebook_user' => $fb,
            'facebook_url' => 'https://www.facebook.com/'.$fb,
            'instagram_user' => $it,
            'instagram_url' => 'https://www.instagram.com/'.$it,
            'general_description' => $this->faker->sentence(),
            'state_id' => $state->id,
            'delegation_id' => $delegation->id,
            'location_id' => $location->id,
        ];
    }
}
