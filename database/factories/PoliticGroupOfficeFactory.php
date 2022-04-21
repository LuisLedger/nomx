<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PoliticGroupOfficeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $state = \App\Models\State::where('id', rand(1,32))->first();
        $delegation = $state->delegations->first();
        $location = $delegation->locations->first();


        return [
            'address'       => $this->faker->address(),
            'state_id'      => $state->id,
            'delegation_id' => $delegation->id,
            'location_id'   => $location->id,
            'phones'        => $this->faker->phoneNumber(),
            'email'         => $this->faker->email(),
            'schedules'     => 'L-V 10-6'
        ];
    }
}
