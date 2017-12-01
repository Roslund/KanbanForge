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


Route::get('/', 'HomeLoginController@index');

/*Route::get('/login', function () {
    return view('login');
});
*/
/* Admin */

Route::resource('admin/categories', 'CategoryController');

Route::get('admin/categories/{category}',
	['as' => 'admin.categories', 'uses' => 'CategoryController@show']);


Route::resource('admin/swimlanes', 'SwimlaneController');

/*
Route::get('admin/swimlanes/{swimlane}',
	['as' => 'admin.swimlanes', 'uses' => 'SwimlaneController@show']);
*/