<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FunctionaryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $state      = \App\Models\State::where('id', rand(1, 32))->first();
        $delegation = $state->delegations->first();
        $location   = $delegation->locations->first();

        return [
            'first_name'          => $this->faker->name,
            'middle_name'         => $this->faker->lastName,
            'last_name'           => $this->faker->lastName,
            'birthdate'           => '1980-01-01',
            'start_time'          => date('Y-m-d'),
            'state_id'            => $state->id,
            'delegation_id'       => $delegation->id,
            'location_id'         => $location->id,
            'functionary_type_id' => rand(1,15),
            'politic_group_id'    => rand(1,25),
            'level_id'            => rand(1,3),
            'profile_url'         => 'https://rotulista.tienda/wp-content/uploads/2020/03/Adhesivo-Cerdito..jpg',
            'status'              => 1,
        ];
    }
}
