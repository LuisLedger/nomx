<?php

namespace Database\Seeders;

use App\Models\CivilOrganization;
use App\Models\Comission;
use App\Models\ComissionType;
use App\Models\FunctionaryType;
use App\Models\GobermentEnterprice;
use App\Models\Level;
use App\Models\Period;
use App\Models\PoliticGroup;
use App\Models\PoliticGroupOffice;
use App\Models\Specialist;
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
        $path = public_path('sql/File.sql');
        $sql  = file_get_contents($path);
        \DB::unprepared($sql);

        User::factory(1)->create([
            'email'      => 'admin@nuevo-orden.com',
            'role'       => 'admin',
            'avatar_url' => 'https://fakeimg.pl/500x500/?text=Avatar',
        ]);

        User::factory(1)->create([
            'email'      => 'manager@nuevo-orden.com',
            'role'       => 'manager',
            'avatar_url' => 'https://fakeimg.pl/500x500/?text=Avatar',
        ]);

        User::factory(1)->create([
            'email'      => 'functionary@nuevo-orden.com',
            'role'       => 'functionary',
            'avatar_url' => 'https://fakeimg.pl/500x500/?text=Avatar',
        ]);

        User::factory(1)->create([
            'email'      => 'sub-functionary@nuevo-orden.com',
            'role'       => 'sub-functionary',
            'avatar_url' => 'https://fakeimg.pl/500x500/?text=Avatar',
        ]);

        User::factory(1)->create([
            'email'      => 'specialist@nuevo-orden.com',
            'role'       => 'specialist',
            'avatar_url' => 'https://fakeimg.pl/500x500/?text=Avatar',
        ]);

        User::factory(1)->create([
            'email'      => 'capturer@nuevo-orden.com',
            'role'       => 'capturer',
            'avatar_url' => 'https://fakeimg.pl/500x500/?text=Avatar',
        ]);

        Period::factory()->count(1)->create([
            'level_id'    => 1,
            'start'       => date('2018-12-01'),
            'end'         => date('2024-11-30'),
            'start_month' => 12,
            'start_year'  => 2018,
            'end_month'   => 11,
            'end_year'    => 2024,
        ]);

        Period::factory()->count(1)->create([
            'level_id'    => 2,
            'start'       => date('2018-12-01'),
            'end'         => date('2024-11-30'),
            'start_month' => 12,
            'start_year'  => 2018,
            'end_month'   => 11,
            'end_year'    => 2024,
        ]);

        Period::factory()->count(1)->create([
            'level_id'    => 1,
            'start'       => date('2021-09-01'),
            'end'         => date('2024-08-31'),
            'start_month' => 9,
            'start_year'  => 2021,
            'end_month'   => 8,
            'end_year'    => 2024,
        ]);

        Period::factory()->count(1)->create([
            'level_id'    => 2,
            'start'       => date('2021-09-01'),
            'end'         => date('2024-08-31'),
            'start_month' => 9,
            'start_year'  => 2021,
            'end_month'   => 8,
            'end_year'    => 2024,
        ]);

        Period::factory()->count(1)->create([
            'level_id'    => 3,
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

        $levels = [
            'Federal' => [
                'Presidente(a)',
                'Secretario(a)',
                'Sub Secretario(a)',
                'Diputado(a)',
                'Senador(a)',
                'Fiscal',
                'Ministro(a)',
            ],
            'Estatal' => [
                'Gobernador(a)',
                'Sub Secretario(a)',
                'Diputado(a)',
                'Senador(a)',
                'Fiscal',
            ],
            'Local'   => [
                'Presidente(a) Municipal',
                'Síndico',
                'Candidato(a)',
                'Pre candidato(a)',
            ],
        ];

        $level_id = 1;
        foreach ($levels as $level => $functionary_types) {
            Level::factory()->count(1)->create([
                'name' => $level,
            ]);
            foreach ($functionary_types as $type) {
                FunctionaryType::factory()->count(1)->create([
                    'name'     => $type,
                    'level_id' => $level_id,
                ]);
            }

            foreach ($groups as $gp) {
                PoliticGroup::factory()->create([
                    'name'       => $gp,
                    'short_name' => $gp,
                    'level_id'   => $level_id,
                ])->each(function ($politic_group) {
                    PoliticGroupOffice::factory()->create([
                        'politic_group_id' => $politic_group->id,
                    ]);
                });
            }

            GobermentEnterprice::factory()->count(3)->create([
                'level_id' => $level_id,
            ]);

            $level_id++;
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
            'Minorías',
            'Social',
            'Seguridad Pública',
            'Migración',
            'Estado de derecho',
        ];
        foreach ($themes as $idx => $theme) {
            ThemeSocial::factory()->count(1)->create([
                'name' => $theme,
            ]);

            $data = ["theme_social_id" => ($idx + 1)];

            CivilOrganization::factory()->count(3)->create($data);

            User::factory(3)->create([
                'role'       => 'specialist',
                'avatar_url' => 'https://fakeimg.pl/500x500/?text=Avatar',
            ])->each(function ($specialist_user) use ($idx) {
                Specialist::factory()->count(1)->create([
                    'principal_theme_social_id' => ($idx + 1),
                    'user_id'                   => $specialist_user->id,
                ]);
            });

            Comission::factory()->count(12)->create([
                'name'     => 'Comisión de ' . $theme,
                'level_id' => rand(1, 3),
            ]);
        }
    }
}
