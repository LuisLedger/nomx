<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCivilOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('civil_organizations', function (Blueprint $table) {
            $table->id();
            $table->integer('theme_social_id');
            $table->string('name');
            $table->string('twitter_user')->nullable();
            $table->string('twitter_url')->nunllable();
            $table->string('facebook_user')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('instagram_user')->nullable();
            $table->string('instagram_url')->nullable();
            $table->text('general_description')->nullable();
            $table->integer('state_id')->nullable();
            $table->integer('delegation_id')->nullable();
            $table->integer('location_id')->nullable();
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
        Schema::dropIfExists('civil_organizations');
    }
}
