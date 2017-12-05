<?php

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

//Get all the artifacts as JSON 
Route::get('/artifact', 'artifactController@index');
