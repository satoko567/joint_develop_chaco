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

Route::get('/', 'PostsController@index');
Route::prefix('users')->group(function () {
    Route::get('{id}', 'PostsController@show')->name('user.show');
});
Route::get('users/{id}/edit', 'UsersController@edit');
Route::put('users/{id}', 'UsersController@update');
