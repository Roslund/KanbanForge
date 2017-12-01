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


<<<<<<< HEAD
=======
Route::get('/', 'HomeLoginController@index');

>>>>>>> origin/master
/*Route::get('/login', function () {
    return view('login');
});
*/
<<<<<<< HEAD

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/users/logout', 'Auth\LoginController@userLogout')->name('user.logout');


Route::prefix('admin')->group(function(){

	/*login*/
	Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
  	Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');

	/*categories*/
	Route::resource('/categories', 'CategoryController');

	Route::get('/categories/{category}',
		['as' => 'admin.categories', 'uses' => 'CategoryController@show']);

	/*swimlanes*/
	Route::resource('/swimlanes', 'SwimlaneController');

	Route::get('/swimlanes/{swimlane}',
		['as' => 'admin.swimlanes', 'uses' => 'SwimlaneController@show']);

	/*dashboard*/
	Route::get('/', 'AdminController@index')->name('admin.dashboard');

	/*logout*/
	 Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

});


=======
/* Admin */
>>>>>>> origin/master





<<<<<<< HEAD
=======
/*
Route::get('admin/swimlanes/{swimlane}',
	['as' => 'admin.swimlanes', 'uses' => 'SwimlaneController@show']);
*/
>>>>>>> origin/master
