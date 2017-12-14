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

Route::get('board', function () {
    $cards = App\Card::all();
    $categories = App\Category::orderBy('parentcategory', 'asc')->orderBy('sortnumber', 'asc')->get();
    $swimlanes = App\Swimlane::orderBy('sortnumber', 'asc')->get();
    $parentCategories = App\ParentCategory::all();

    $data = array('cards' => $cards,
      'categories' => $categories,
      'swimlanes' => $swimlanes,
      'parentCategories' => $parentCategories);

    return view('board')->with($data);
});

Route::get('/logout', 'Auth\UsersLoginController@logout');



Route::prefix('admin')->group(function(){

	/*categories*/
	Route::resource('/categories', 'CategoryController');


	/*swimlanes*/
	Route::resource('/swimlanes', 'SwimlaneController');
	Route::put('/swimlanes', 'SwimlaneController@updateKevinVersion');

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
