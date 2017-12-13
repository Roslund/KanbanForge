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

Route::get('/', 'HomeController@index');

Route::get('login', 'Auth\UsersLoginController@showLoginForm')->name('users.login');

Route::post('login', 'Auth\UsersLoginController@login')->name('login.submit');


Route::get('welcome', function () {
    return view('welcomeboard');
});

Route::get('/logout', 'Auth\UsersLoginController@logout');


Route::prefix('admin')->group(function(){

	/*categories*/
	Route::resource('/categories', 'CategoryController');

	/*Route::get('/categories/{category}',
		['as' => 'admin.categories', 'uses' => 'CategoryController@show']);

	/*swimlanes*/
	Route::resource('/swimlanes', 'SwimlaneController');

	/*Route::get('/swimlanes/{swimlane}',
		['as' => 'admin.swimlanes', 'uses' => 'SwimlaneController@show']);
	*/

	/*parentcategories*/
	Route::resource('/parentcategories', 'ParentCategoryController');

	/*see all artifacts*/
	Route::get('filter', 'ArtifactController@index');

	/*refresh artifacts*/
	Route::get('filter/update', 'ArtifactController@refresh');

	/*selected artifacts*/
	Route::post('selected', 'ArtifactController@select');

  Route::get('/projects', 'ProjectController@index');
  Route::get('projects/update', 'ProjectController@refresh');
  Route::post('change', 'ProjectController@change');


});
