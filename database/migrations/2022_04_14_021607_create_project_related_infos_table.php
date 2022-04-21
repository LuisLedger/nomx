<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectRelatedInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_related_infos', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id');
            $table->integer('promote_functionary_id')->nullable();
            $table->integer('especialist_id')->nullable();
            $table->string('title',300);
            $table->text('description');
            $table->string('url');
            $table->string('image_url');
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
        Schema::dropIfExists('project_related_infos');
    }
}
