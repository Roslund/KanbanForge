<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Card related api routes
Route::get('/cards', 'CardApiController@index');

Route::get('/cards/updatedsince/{dateTime}', 'CardApiController@checkIfUpdatedSince');

Route::get('/cards/{id}', 'CardApiController@show');

Route::put('/cards/{id}', 'CardApiController@update');
