<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::controller('genre','GenreController');
Route::controller('category','CategoryController');
Route::controller('ressource','RessourceController');
Route::controller('artist','ArtistController');

Route::get('/', function()
{
	return View::make('hello');
        //Route::controller('genre', 'GenreController');
});

