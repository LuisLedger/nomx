<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFunctionaryContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('functionary_contacts', function (Blueprint $table) {
            $table->id();
            $table->integer('functionary_id');
            $table->string('type');
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('email',300);
            $table->string('phone',20);
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
        Schema::dropIfExists('functionary_contacts');
    }
}
