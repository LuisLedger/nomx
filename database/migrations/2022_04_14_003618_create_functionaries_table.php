<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFunctionariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Perfil del funcionario publico */
        Schema::create('functionaries', function (Blueprint $table) {
            $table->id();
            $table->integer('parent')->nullable();
            $table->string('first_name',300);
            $table->string('middle_name',300)->nullable();
            $table->string('last_name',300)->nullable();
            $table->datetime('birthdate')->nullable();
            $table->datetime('election_type')->nullable();
            $table->datetime('start_time')->nullable();
            $table->bigInteger('state_id')->nullable();
            $table->bigInteger('delegation_id')->nullable();
            $table->bigInteger('location_id')->nullable();
            $table->bigInteger('district_id')->nullable();
            $table->integer('functionary_type_id');
            $table->integer('politic_group_id');
            $table->integer('level_id');
            $table->string('profile_url')->nullable();
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
        Schema::dropIfExists('functionaries');
    }
}
