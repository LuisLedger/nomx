<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoliticGroupOfficesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('politic_group_offices', function (Blueprint $table) {
            $table->id();
            $table->integer('politic_group_id');
            $table->text('address');
            $table->bigInteger('state_id')->nullable();
            $table->bigInteger('delegation_id')->nullable();
            $table->bigInteger('location_id')->nullable();
            $table->bigInteger('district_id')->nullable();
            $table->string('phones')->nullable();
            $table->string('email')->nullable();
            $table->string('schedules')->nullable();
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
        Schema::dropIfExists('politic_group_offices');
    }
}
