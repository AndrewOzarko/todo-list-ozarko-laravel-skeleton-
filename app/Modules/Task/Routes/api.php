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

    Route::get('tasks', 'ApiController@getAllTasks');

    Route::get('tasks/{id}', 'ApiController@getTaskById');

    Route::post('tasks', 'ApiController@createTask');

    Route::put('tasks', 'ApiController@updateTask');

    Route::delete('tasks/{id}', 'ApiController@deleteTask');

});