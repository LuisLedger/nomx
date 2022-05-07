<?php

namespace Database\Seeders;

use App\Models\Functionary;
use App\Models\FunctionaryActivity;
use App\Models\FunctionaryAssistance;
use App\Models\FunctionaryContact;
use App\Models\FunctionarySocialMedia;
use App\Models\FunctionaryVote;
use App\Models\FunctionaryPeriod;
use App\Models\Law;
use App\Models\LawRelatedInfo;
use App\Models\LawThemes;
use App\Models\Project;
use App\Models\ProjectThemes;
use App\Models\Proposal;
use App\Models\ProposalThemes;
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
        Functionary::factory()->count(150)->create()->each(function ($functionary) {

            $valid = true;
            if ($functionary->level_id == 1 && $functionary->functionary_type_id == 4) {
                $functionary->delete();
                $valid = false;
            }
            
            if ($valid) {
                FunctionaryContact::factory()->count(rand(1, 3))->create([
                    'functionary_id' => $functionary->id,
                ]);

                FunctionarySocialMedia::factory()->count(rand(1, 3))->create([
                    'functionary_id' => $functionary->id,
                ]);

                if (rand(0,1)) {
                    FunctionaryAssistance::factory()->count(1)->create([
                        'functionary_id' => $functionary->id,
                        'period_id'      => 4,
                    ]);
                }

                Law::factory()->count(rand(9,15))->create([
                    'promote_functionary_id' => $functionary->id,
                    'level_id'               => $functionary->level_id,
                    'politic_group_id'       => $functionary->politic_group_id,
                    'period_id'              => 1,
                ])->each(function ($law) use ($functionary) {
                    LawRelatedInfo::factory()->count(rand(3, 5))->create([
                        'law_id'                 => $law->id,
                        'promote_functionary_id' => $functionary->id,
                        'period_id'              => 1,
                    ]);

                    FunctionaryActivity::factory()->count(rand(6,9))->create([
                        'functionary_id' => $functionary->id,
                        'law_id'         => $law->id,
                        'period_id'      => 4,
                    ]);

                    LawThemes::factory()->count(1)->create(['law_id' => $law->id]);
                });

                Project::factory()->count(rand(9, 15))->create([
                    'promote_functionary_id' => $functionary->id,
                    'politic_group_id'       => $functionary->politic_group_id,
                    'level_id'               => $functionary->level_id,
                    'period_id'              => 1,
                ])->each(function ($project) use ($functionary) {
                    FunctionaryActivity::factory()->count(rand(6,9))->create([
                        'functionary_id' => $functionary->id,
                        'project_id'     => $project->id,
                        'period_id'      => 4,
                    ]);

                    ProjectThemes::factory()->count(1)->create(['project_id' => $project->id]);
                });

                Proposal::factory()->count(rand(9, 15))->create([
                    'promote_functionary_id' => $functionary->id,
                    'politic_group_id'       => $functionary->politic_group_id,
                    'level_id'               => $functionary->level_id,
                    'period_id'              => 1,
                ])->each(function($proposal){
                    ProposalThemes::factory()->count(1)->create(['proposal_id' => $proposal->id]);
                });

                FunctionaryVote::factory()->count(1)->create([
                    'functionary_id' => $functionary->id,
                    'period_id'      => 4,
                    'level_id'       => $functionary->level_id,
                ]);

                FunctionaryPeriod::factory()->create([
                    'functionary_id'      => $functionary->id,
                    'functionary_type_id' => $functionary->functionary_type_id,
                    'period_id'           => 1,
                ]);
            }
        });
    }
}