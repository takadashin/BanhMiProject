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

Route::post('admin/editrecipe','RecipeController@editrecipe');
Route::controller('admin/editdetailrecipe', 'AdminRecipeController');

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

Route::controller('postRecipe', 'PostRecipeController');
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

Route::get('chef','UserController@listChefForUser');


//Route::get('admin/chefs/list','UserController@listChefForAdmin');
Route::get('admin/chefs/list',['middleware' => 'guest','uses' => 'SessionController@adminLogin']);
Route::get('admin/chefs/list',['middleware' => ['auth', 'admin'], 'uses' => 'UserController@listChefForAdmin']);

Route::get('userprofile','UserController@showProfile');

Route::post('userprofile', 'UserController@editProfile');

Route::get('userprofile/delete/{id}', 'UserController@deleteRecipe');

//Route::get('admin/edit_chef/{id}', 'UserController@editChef');
Route::get('admin/edit_chef/{id}',['middleware' => 'guest','uses' => 'SessionController@adminLogin']);
Route::get('admin/edit_chef/{id}',['middleware' => ['auth', 'admin'], 'uses' => 'UserController@editChef']);


//Route::post('admin/chefs/update', 'UserController@updateChef');
Route::get('admin/chefs/update',['middleware' => 'guest','uses' => 'SessionController@adminLogin']);
Route::get('admin/chefs/update',['middleware' => ['auth', 'admin'], 'uses' => 'UserController@updateChef']);

//Route::get('admin/chefs/delete/{id}', 'UserController@deleteChef');
Route::get('admin/chefs/delete/{id}',['middleware' => 'guest','uses' => 'SessionController@adminLogin']);
Route::get('admin/chefs/delete/{id}',['middleware' => ['auth', 'admin'], 'uses' => 'UserController@deleteChef']);

Route::get('admin/create_chef',['middleware' => ['auth', 'admin'], function () {
    return view('pages.admin.chefs.create_chef');
}]);

//Route::post('admin/chefs/create', 'UserController@createChef');
Route::get('admin/chefs/create',['middleware' => 'guest','uses' => 'SessionController@adminLogin']);
Route::get('admin/chefs/create',['middleware' => ['auth', 'admin'], 'uses' => 'UserController@createChef']);

//Route::get('admin/detail_chef/{id}', 'UserController@detailChef');
Route::get('admin/detail_chef/{id}',['middleware' => 'guest','uses' => 'SessionController@adminLogin']);
Route::get('admin/detail_chef/{id}',['middleware' => ['auth', 'admin'], 'uses' => 'UserController@detailChef']);

//Route::post('admin/chefs/search', 'SearchController@searchUser');
Route::get('admin/chefs/search',['middleware' => 'guest','uses' => 'SessionController@adminLogin']);
Route::get('admin/chefs/search',['middleware' => ['auth', 'admin'], 'uses' => 'SearchController@searchUser']);
// ------ Huyen
