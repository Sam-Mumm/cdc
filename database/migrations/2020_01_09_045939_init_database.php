<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InitDatabase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artist', function ($table) {
            $table->bigIncrements('id');
            $table->string('first_name', 50)->nullable();
            $table->string('last_name', 255);
            $table->timestamps();
        });

        Schema::create('category', function ($table) {
            $table->bigIncrements('id');
            $table->string('name', 50);
            $table->boolean('show_artist');
            $table->timestamps();
        });

        Schema::create('genre', function ($table) {
            $table->bigIncrements('id');
            $table->string('name', 50);
            $table->timestamps();
        });

        Schema::create('medium', function ($table) {
            $table->bigIncrements('id');
            $table->string('name', 50);
            $table->timestamps();
        });

        Schema::create('album', function ($table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('genre_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('medium_id');
            $table->string('year', 4);
            $table->string('title', 50);
            $table->string('cover_path', 75)->nullable();
            $table->timestamps();
        });

        Schema::create('cd', function ($table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('album_id');
            $table->unsignedInteger('cd_no')->default(1);
            $table->timestamps();
        });

        Schema::create('album_artist', function ($table) {
            $table->unsignedBigInteger('album_id');
            $table->unsignedBigInteger('artist_id');
        });

        Schema::create('track', function ($table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('artist_id');
            $table->unsignedBigInteger('cd_id');
            $table->unsignedInteger('number');
            $table->string('name', 75);
            $table->integer('length')->unsigned();
            $table->integer('rating')->unsigned()->default(0);
            $table->boolean('show_artist')->default(false);
            $table->string('composer', 50)->nullable();;
            $table->longText('lyrics')->nullable();;
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
        Schema::drop('track');
        Schema::drop('cd');
        Schema::drop('album_artist');
        Schema::drop('album');
        Schema::drop('category');
        Schema::drop('genre');
        Schema::drop('artist');
        Schema::drop('medium');
    }
}
