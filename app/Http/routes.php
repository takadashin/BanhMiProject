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
//Added by Huyen 2015-12-04
Route::post('admin/(:any)',['middleware' => 'guest','uses' => 'SessionController@adminLogin']);
//End

Route::get('index' , 'RecipeController@index');
Route::get('recipe','RecipeController@recipe');
Route::get('recipe/{id}','RecipeController@detail');
Route::get('/','RecipeController@index');


Route::post('commentsubmit','CommentController@create');
Route::get('searchsubmit','RecipeController@search');
Route::get('getfollow/{cid}/{rid}', 'FollowController@followchef');
Route::get('getmade/{rid}', 'MadeController@recipemade');
Route::get('getvote/{rid}', 'VoteController@recipevote');


Route::post('commentsubmit','CommentController@create');
Route::get('admin/recipe','RecipeController@adminrecipe');
Route::get('admin/recipe/delete/{id}','RecipeController@deleterecipe');
Route::get('admin/recipe/edit/{id}','RecipeController@editrecipe');
Route::get('admin/recipe/edit/addstep/{id}','RecipeController@addsteprecipe');

Route::post('admin/editrecipe/addstep/{id}','RecipeController@addstepdetail');
Route::post('admin/editcontentrecipe/{id}','RecipeController@editcontentrecipe');
Route::controller('admin/editdetailrecipe', 'AdminRecipeController');

// ------ Linh
Route::get('/admin',['middleware' => ['auth', 'admin'], function () {
    return Redirect('admin/recipe');
}]);
Route::get('twitterLogin', 'SessionController@twitterLogin');
Route:resource('sessions', 'SessionController');
Route::get('login',['middleware' => 'guest','uses' => 'SessionController@create']);
Route::get('logout', 'SessionController@destroy');
Route::get('admin/login', ['middleware' => 'guest','uses' => 'SessionController@adminLogin']);
Route::post('admin/loginStore', 'SessionController@adminStore');

Route::controller('admin/ingredient', 'IngredientController');

Route::controller('postRecipe', 'PostRecipeController');
Route::get('postRecipe/{id}', 'PostRecipeController@getIndex');

// ------ Linh




// ------ Huyen ----- //
//--about---//
Route::get('about', function () {
    return view('pages.about');
});
Route::post('about', 'ContactController@sendContact');

// --- register ---//
Route::get('register', function () { 
    return view('pages.register');
});
Route::post('register', 'UserController@createUser');
Route::get('register/verify/{confirmationCode}','UserController@confirm');
Route::get('register/confirmation', function () {
    return view('pages.confirmation');
});

//----chef list --- //
Route::get('chef','UserController@listChefForUser');
Route::get('chef/searchU/{users}','SearchController@listResultUser');
Route::get('chef/searchR/{recipes}','SearchController@listResultRecipe');

//------userprofile----//
Route::get('userprofile/{username}','UserController@showProfile');
Route::post('userprofile', 'UserController@editProfile');
Route::get('userprofile/delete/{id}', 'UserController@deleteRecipe');

// ---- admin of user ----//
Route::get('admin/chefs/list',['middleware' => ['auth', 'admin'], 'uses' => 'UserController@listChefForAdmin']);
Route::get('admin/edit_chef/{id}',['middleware' => ['auth', 'admin'], 'uses' => 'UserController@editChef']);
Route::post('admin/chefs/update',['middleware' => ['auth', 'admin'], 'uses' => 'UserController@updateChef']);
Route::get('admin/chefs/delete/{id}',['middleware' => ['auth', 'admin'], 'uses' => 'UserController@deleteChef']);
Route::get('admin/create_chef',['middleware' => ['auth', 'admin'], function () {
    return view('pages.admin.chefs.create_chef');
}]);
Route::post('admin/chefs/create',['middleware' => ['auth', 'admin'], 'uses' => 'UserController@createChef']);
Route::get('admin/detail_chef/{id}',['middleware' => ['auth', 'admin'], 'uses' => 'UserController@detailChef']);
Route::post('admin/chefs/search',['middleware' => ['auth', 'admin'], 'uses' => 'SearchController@searchUser']);

//-----admin of contact-----//
Route::get('admin/contacts/list',['middleware' => ['auth', 'admin'], 'uses' => 'ContactController@listContact']);
Route::get('admin/contacts/detail/{id}',['middleware' => ['auth', 'admin'], 'uses' => 'ContactController@detailContact']);
Route::post('admin/contacts/reply',['middleware' => ['auth', 'admin'], 'uses' => 'ContactController@replyContact']);
Route::get('admin/contacts/delete/{id}',['middleware' => ['auth', 'admin'], 'uses' => 'ContactController@deleteContact']);
Route::post('admin/contacts/search',['middleware' => ['auth', 'admin'], 'uses' => 'SearchController@searchContact']);

//----search-----
Route::post('home/search', 'SearchController@search');
// --------- Huyen  ---------- //
