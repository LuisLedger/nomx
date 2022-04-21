<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFunctionaryVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('functionary_votes', function (Blueprint $table) {
            $table->id();
            $table->integer('functionary_id');
            $table->integer('period_id');
            $table->integer('level_id');
            $table->datetime('vote_day');
            $table->integer('law_id')->nullable();
            $table->integer('project_id')->nullable();
            $table->integer('vote_type_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('functionary_votes');
    }
}
