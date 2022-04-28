<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoliticGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('politic_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name',300);
            $table->string('short_name', 50);
            $table->text('mission')->nullable();
            $table->text('vission')->nullable();
            $table->text('description')->nullable();
            $table->integer('level_id');
            $table->string('logo')->nullable();
            $table->datetime('fundation_date')->nullable();
            $table->integer('leader_functionary_id')->nullable();
            $table->integer('status');
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
        Schema::dropIfExists('politic_groups');
    }
}
