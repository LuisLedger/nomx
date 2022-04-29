<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitizensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('citizens', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('principal_theme_social_id')->nullable();
            $table->integer('principal_civil_organization_id')->nullable();
            $table->string('twitter_user')->nullable();
            $table->string('facebook_user')->nullable();
            $table->string('instagram_user')->nullable();
            $table->text('general_description')->nullable();
            $table->text('web_site')->nullable();
            $table->bigInteger('state_id')->nullable();
            $table->bigInteger('delegation_id')->nullable();
            $table->bigInteger('location_id')->nullable();
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
        Schema::dropIfExists('citizens');
    }
}
