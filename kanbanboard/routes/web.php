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
    $cards = App\Card::all();
    $categories = App\Category::orderBy('parentcategory', 'asc')->orderBy('id', 'asc')->get();
    $swimlanes = App\Swimlane::all();
    $parentCategories = App\ParentCategory::all();

    $data = array('cards' => $cards,
      'categories' => $categories,
      'swimlanes' => $swimlanes,
      'parentCategories' => $parentCategories);

    return view('welcomeboard')->with($data);
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

});
