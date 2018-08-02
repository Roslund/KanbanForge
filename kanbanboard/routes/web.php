<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	if(\Auth::check() || \Auth::guard('teamforge')->check()){
		return redirect('/board');
	}
	return redirect('/login');
});

Route::get('login', 'Auth\UsersLoginController@showLoginForm')->name('users.login');

Route::post('login', 'Auth\UsersLoginController@login')->name('login.submit');

Route::get('board', 'BoardController@index');

Route::get('/logout', 'Auth\UsersLoginController@logout');


Route::prefix('admin')->group(function(){
	/*categories*/
	Route::resource('/categories', 'CategoryController');
	Route::get('/categories/{category}', 'CategoryController@increment');
	Route::get('/categoriess/{category}', 'CategoryController@decrement');

	/*swimlanes*/
	Route::resource('/swimlanes', 'SwimlaneController');
	Route::get('/swimlaness/{swimlane}', 'SwimlaneController@increment');
	Route::get('/swimlanes/{swimlane}', 'SwimlaneController@decrement');


	/*parentcategories*/
	Route::resource('/parentcategories', 'ParentCategoryController');

	/*see all artifacts*/
	Route::get('filter', 'ArtifactController@index');

	/*refresh artifacts*/
	Route::get('filter/update', 'ArtifactController@refresh');

	/*selected artifacts*/
	Route::post('selected', 'ArtifactController@select');

	/*projects*/
  	Route::get('/projects', 'ProjectController@index');
  	Route::get('projects/update', 'ProjectController@refresh');
  	Route::post('change', 'ProjectController@change');

	/*Logging*/
	Route::get('/log', 'BoardLogController@index');
});

// Card related api routes
Route::prefix('api')->middleware('auth:teamforge,web')->group(function(){
	Route::get('/cards', 'CardApiController@index');

	Route::post('/cards/updatedsince/{dateTime}', 'CardApiController@checkIfUpdatedSince');

	Route::get('/cards/{id}', 'CardApiController@show');

	Route::put('/cards/{id}', 'CardApiController@update');
});
