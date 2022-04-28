<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLawRelatedInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('law_related_infos', function (Blueprint $table) {
            $table->id();
            $table->integer('law_id');
            $table->integer('period_id');
            $table->integer('promote_functionary_id')->nullable();
            $table->integer('especialist_id')->nullable();
            $table->string('title',300);
            $table->text('description');
            $table->string('url');
            $table->string('image_url')->nullable();
            $table->integer('vote_type_id')->nullable();
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
        Schema::dropIfExists('law_related_infos');
    }
}
