<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduleSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_sessions', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id')->nullable();
            $table->datetime('session_date');
            $table->datetime('end_date')->nullable();
            $table->integer('functionary_type_id');
            $table->integer('level_id');
            $table->integer('period_id')->nullable();
            $table->text('description')->nullable();
            $table->integer('state_id')->nullable();
            $table->integer('delegation_id')->nullable();
            $table->text('json_related_laws_id')->nullable();
            $table->text('json_related_proposals_id')->nullable();
            $table->text('json_related_projects_id')->nullable();
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('schedule_sessions');
    }
}
