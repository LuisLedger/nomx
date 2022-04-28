<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFunctionaryActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('functionary_activities', function (Blueprint $table) {
            $table->id();
            $table->integer('period_id');
            $table->integer('functionary_id');
            $table->integer('project_id')->nullable();
            $table->integer('law_id')->nullable();
            $table->text('description');
            $table->string('url')->nullable();
            $table->string('image_url')->nullable();
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
        Schema::dropIfExists('functionary_activities');
    }
}
