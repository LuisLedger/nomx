<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProposalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proposals', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id')->nullable();
            $table->string('proposal_name');
            $table->text('description');
            $table->integer('level_id');
            $table->integer('promote_functionary_id')->nullable();
            $table->integer('politic_group_id')->nullable();
            $table->integer('start_period_id')->nullable();
            $table->integer('execution_period_id')->nullable();
            $table->string('url_global_info')->nullable();
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
        Schema::dropIfExists('proposals');
    }
}
