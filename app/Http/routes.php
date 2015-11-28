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
Route::get('auth/twitterLogin', 'Auth\AuthController@twitterLogin');
Route::get('auth/logout', 'Auth\AuthController@logout');

Route::post('commentsubmit','CommentController@create');
Route::get('getfollow/{cid}/{uid}/{rid}', 'FollowController@followchef');
Route::get('getmade/{uid}/{rid}', 'MadeController@recipemade');
Route::get('getvote/{uid}/{rid}', 'VoteController@recipevote');