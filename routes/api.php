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

Route::post('/addproperty', [
    'uses' => 'PostController@Storeproperty'
]);

Route::get('/getproperties', [
    'middleware' => 'cors',
    'uses' => 'PostController@Getproperties'
]);

Route::get('/viewproperty/{id}', [
    'uses' => 'PostController@Viewproperty'
]);

Route::get('/searchproperty/{id}', [
    'uses' => 'PostController@Findproperty'
]);

Route::post('/deleteproperty/{id}', [
    'uses' => 'PostController@Deleteproperty'
]);