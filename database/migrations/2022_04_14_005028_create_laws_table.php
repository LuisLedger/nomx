<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLawsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laws', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id')->nullable();
            $table->string('law_name');
            $table->text('description');
            $table->integer('period_id');
            $table->integer('level_id');
            $table->datetime('discussion_date')->nullable();
            $table->datetime('votation_date')->nullable();
            $table->datetime('aprove_date')->nullable();
            $table->bigInteger('state_id')->nullable();
            $table->bigInteger('delegation_id')->nullable();
            $table->bigInteger('location_id')->nullable();
            $table->integer('promote_functionary_id')->nullable();
            $table->integer('politic_group_id')->nullable();
            $table->integer('start_period_id')->nullable();
            $table->integer('execution_period_id')->nullable();
            $table->string('url_global_info')->nullable();
            $table->string('image_url')->nullable();
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
        Schema::dropIfExists('laws');
    }
}
