<?php

namespace Database\Seeders;

use App\Models\CivilOrganization;
use App\Models\Comission;
use App\Models\ComissionType;
use App\Models\Delegation;
use App\Models\Especialist;
use App\Models\FunctionaryType;
use App\Models\GobermentEnterprice;
use App\Models\Level;
use App\Models\Location;
use App\Models\Period;
use App\Models\PoliticGroup;
use App\Models\PoliticGroupOffice;
use App\Models\State;
use App\Models\ThemeSocial;
use App\Models\User;
use App\Models\VoteType;
use Illuminate\Database\Seeder;

class CatalogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(1)->create([
            'email' => 'admin@nuevo-orden.com',
            'role'  => 'admin',
        ]);

        User::factory(1)->create([
            'email' => 'manager@nuevo-orden.com',
            'role'  => 'manager',
        ]);

        User::factory(1)->create([
            'email' => 'functionary@nuevo-orden.com',
            'role'  => 'functionary',
        ]);

        User::factory(1)->create([
            'email' => 'sub-functionary@nuevo-orden.com',
            'role'  => 'sub-functionary',
        ]);

        User::factory(1)->create([
            'email' => 'especialist@nuevo-orden.com',
            'role'  => 'especialist',
        ]);

        User::factory(1)->create([
            'email' => 'capturer@nuevo-orden.com',
            'role'  => 'capturer',
        ]);

        State::factory()->count(33)->create()->each(function ($state) {
            Delegation::factory()->count(rand(1, 3))->create([
                'state_id' => $state->id,
            ])->each(function ($delegation) {
                Location::factory()->count(rand(1, 3))->create([
                    'delegation_id' => $delegation->id,
                ]);
            });
        });

        Period::factory()->count(1)->create([
            'level_id'    => 1,
            'start'       => date('2021-09-01'),
            'end'         => date('2024-08-31'),
            'start_month' => 9,
            'start_year'  => 2021,
            'end_month'   => 8,
            'end_year'    => 2024,
        ]);

        ComissionType::factory()->count(3)->create();
        VoteType::factory()->count(1)->create([
            'name' => 'A favor',
        ]);
        VoteType::factory()->count(1)->create([
            'name' => 'En contra',
        ]);
        VoteType::factory()->count(1)->create([
            'name' => 'Abstención',
        ]);

        $functionary_types = [
            'Presidente(a)',
            'Gobernador(a)',
            'Presidente(a) Municipal',
        ];
        $count = 1;
        foreach ($functionary_types as $functionary) {
            FunctionaryType::factory()->count(1)->create([
                'name'     => $functionary,
                'level_id' => $count,
            ]);
            $count++;
        }

        $levels = [
            'Federal',
            'Estatal',
            'Local',
        ];
        $groups = [
            "PRI",
            "PAN",
            "PRD",
            "MORENA",
            "MC",
            "PT",
            "PVE",
            "PRD",
            "Nueva Alianza",
            "PSO",
        ];

        $functionary_types = [
            'Pre candidato(a)',
            'Candidato(a)',
            'Diputado(a)',
            'Senador(a)',
        ];
        foreach ($levels as $level_name) {
            Level::factory()->count(1)->create([
                'name' => $level_name,
            ])->each(function ($level) use ($functionary_types, $groups) {
                foreach ($functionary_types as $functionary) {
                    FunctionaryType::factory()->count(1)->create([
                        'name'     => $functionary,
                        'level_id' => $level->id,
                    ]);
                }

                foreach ($groups as $gp) {
                    PoliticGroup::factory()->create([
                        'name'     => $gp,
                        'level_id' => $level->id,
                    ])->each(function ($politic_group) {
                        PoliticGroupOffice::factory()->create([
                            'politic_group_id' => $politic_group->id,
                        ]);
                    });
                }

                GobermentEnterprice::factory()->count(3)->create([
                    'level_id' => $level->id,
                ]);
            });
        }

        $themes = [
            'Agricultura',
            'Ganadería',
            'Arte',
            'Cultura',
            'Ciencia y Tecnología',
            'Educación',
            'Salud',
            'Economía',
            'Medio Ambiente',
            'Social',
            'Seguridad Pública',
            'Estado de derecho',
        ];
        foreach ($themes as $idx => $theme) {
            ThemeSocial::factory()->count(1)->create([
                'name' => $theme,
            ]);

            $data = ["theme_social_id" => ($idx + 1)];

            CivilOrganization::factory()->count(3)->create($data);

            Especialist::factory()->count(3)->create($data);

            Comission::factory()->count(12)->create([
                'name'     => 'Comisión de '.$theme,
                'level_id' => rand(1, 3),
            ]);
        }
    }
}