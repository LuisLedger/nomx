<?php

namespace Database\Seeders;

use App\Models\Functionary;
use App\Models\FunctionaryAssistance;
use App\Models\FunctionaryContact;
use App\Models\FunctionarySocialMedia;
use App\Models\FunctionaryVote;
use App\Models\Law;
use App\Models\LawRelatedInfo;
use App\Models\Project;
use Illuminate\Database\Seeder;

class FunctionarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Functionary::factory()->count(50)->create()->each(function ($functionary) {
            FunctionaryContact::factory()->count(rand(1, 3))->create([
                'functionary_id' => $functionary->id,
            ]);

            FunctionarySocialMedia::factory()->count(rand(1, 3))->create([
                'functionary_id' => $functionary->id,
            ]);

            if (rand(0, 1)) {
                FunctionaryAssistance::factory()->count(1)->create([
                    'functionary_id' => $functionary->id,
                ]);
            }

            if (rand(0, 1)) {
                Law::factory()->count(rand(1, 5))->create([
                    'promote_functionary_id' => $functionary->id,
                    'level_id'               => $functionary->level_id,
                    'politic_group_id'       => $functionary->politic_group_id,
                ])->each(function ($law) use ($functionary) {
                    LawRelatedInfo::factory()->count(rand(1, 5))->create([
                        'law_id'                 => $law->id,
                        'promote_functionary_id' => $functionary->id,
                    ]);
                });
            }

            if (rand(0, 1)) {
                Project::factory()->count(rand(1, 3))->create([
                    'promote_functionary_id' => $functionary->id,
                    'politic_group_id'       => $functionary->politic_group_id,
                    'level_id'               => $functionary->level_id,
                ]);
            }

            FunctionaryVote::factory()->count(1)->create([
                'functionary_id' => $functionary->id,
                'period_id'      => 1,
                'level_id'       => $functionary->level_id
            ]);
        });
    }
}
