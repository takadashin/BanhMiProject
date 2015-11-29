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
Route::get('getfollow/{cid}/{uid}/{rid}', 'FollowController@followchef');
Route::get('getmade/{uid}/{rid}', 'MadeController@recipemade');
Route::get('getvote/{uid}/{rid}', 'VoteController@recipevote');


Route::post('commentsubmit','CommentController@create');


// ------ Linh
Route::get('/admin',['middleware' => ['auth', 'admin'], function () {
    return view('pages.admin.index');
}]);
Route::get('twitterLogin', 'SessionController@twitterLogin');
Route:resource('sessions', 'SessionController');
Route::get('login',['middleware' => 'guest','uses' => 'SessionController@create']);
Route::get('logout', 'SessionController@destroy');
Route::get('admin/login', ['middleware' => 'guest','uses' => 'SessionController@adminLogin']);
Route::post('admin/loginStore', 'SessionController@adminStore');

Route::controller('ingredient', 'IngredientController');
Route::get('admin/ingredient', ['middleware' => ['auth','admin'],  function(){
    return view('pages.admin.ingredient');
}]);
// ------ Linh

