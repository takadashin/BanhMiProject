<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



Route::get('index' , 'RecipeController@index');
Route::get('recipe','RecipeController@recipe');
Route::get('recipe/{id}','RecipeController@detail');
Route::get('/', function () {
    return view('pages.home');
});


Route::post('commentsubmit','CommentController@create');

// ------ Linh
Route::get('twitterLogin', 'SessionController@twitterLogin');
Route:resource('sessions', 'SessionController');
Route::get('login', 'SessionController@create');
Route::get('logout', 'SessionController@destroy');
// ------ Linh