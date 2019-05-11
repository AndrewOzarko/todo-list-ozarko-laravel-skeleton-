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

Route::middleware('auth:api')->group(function () {
    Route::get('categories', 'ApiController@getAllCategories');

    Route::get('categories/{id}', 'ApiController@getCategoryById');

    Route::post('categories', 'ApiController@createCategory');

    Route::put('categories', 'ApiController@updateCategory');

    Route::delete('categories/{id}', 'ApiController@deleteCategory');
});
