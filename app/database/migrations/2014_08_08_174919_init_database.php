<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InitDatabase extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{            
        Schema::create('artist', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('first_name',50);
            $table->string('last_name',255); 
            $table->timestamps();
        });

        Schema::create('category', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name',50);
            $table->boolean('show_artist');      
            $table->timestamps();
        });

        Schema::create('genre', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name',50);  
            $table->timestamps();
        });

        Schema::create('ressource', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name',50);       
            $table->timestamps();
        });

        Schema::create('album', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('artist_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->integer('genre_id')->unsigned();
            $table->integer('ressource_id')->unsigned();
            $table->string('year',4);
            $table->string('title',50);
            $table->string('address',75);   
            $table->timestamps();

            $table->foreign('artist_id')->references('id')->on('artist')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('category')->onDelete('cascade');
            $table->foreign('genre_id')->references('id')->on('genre')->onDelete('cascade');
            $table->foreign('ressource_id')->references('id')->on('ressource')->onDelete('cascade');
        });
        
        Schema::create('cd', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('album_id')->unsigned();      
            $table->integer('cd_no')->unsigned();
            $table->timestamps();

            $table->foreign('album_id')->references('id')->on('album')->onDelete('cascade');
        });

        
        Schema::create('track', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('artist_id')->unsigned();
            $table->integer('cd_id')->unsigned();
            $table->integer('number')->unsigned();
            $table->string('name',75);  
            $table->integer('length')->unsigned();
            $table->boolean('show_artist');
            $table->integer('rating')->unsigned();
            $table->string('composer',50);  
            $table->longText('lyrics');  
            $table->timestamps();

            $table->foreign('artist_id')->references('id')->on('artist')->onDelete('cascade');
            $table->foreign('cd_id')->references('id')->on('cd')->onDelete('cascade');
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
        Schema::drop('album');
        Schema::drop('ressource');
        Schema::drop('genre');
        Schema::drop('category');
        Schema::drop('artist');
    }

}
