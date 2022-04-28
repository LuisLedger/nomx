<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFunctionaryAssistancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('functionary_assistances', function (Blueprint $table) {
            $table->id();
            $table->integer('period_id');
            $table->integer('incidence_id');
            $table->integer('functionary_id');
            $table->datetime('incidence_date');
            $table->text('incidence')->nullable();
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
        Schema::dropIfExists('functionary_assistances');
    }
}
