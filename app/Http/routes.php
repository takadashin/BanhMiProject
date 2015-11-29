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
Route::get('getfollow/{cid}/{rid}', 'FollowController@followchef');
Route::get('getmade/{rid}', 'MadeController@recipemade');
Route::get('getvote/{rid}', 'VoteController@recipevote');


Route::post('commentsubmit','CommentController@create');
Route::get('admin/recipe','RecipeController@adminrecipe');
Route::get('admin/recipe/delete/{id}','RecipeController@deleterecipe');
Route::get('admin/recipe/edit/{id}','RecipeController@editrecipe');
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

Route::controller('admin/ingredient', 'IngredientController');
// ------ Linh


// ------ Huyen
Route::get('about', function () {
    return view('pages.about');
});

Route::post('about', 'UserController@sendContact');

Route::get('register', function () { 
    return view('pages.register');
});

Route::post('register', 'UserController@createUser');

Route::get('register/verify/{confirmationCode}','UserController@confirm');

Route::get('register/confirmation', function () {
    return view('pages.confirmation');
});

Route::get('chef','UserController@listChef');

Route::get('userprofile','UserController@showProfile');

Route::post('userprofile', 'UserController@editProfile');

Route::delete('userprofile/delete', 'UserController@deleteRecipe');
// ------ Huyen
