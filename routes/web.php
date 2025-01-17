<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'PostsController@index')->name('home');

Route::group([ 'middleware' => 'auth' ], function(){
    Route::prefix('post/{id}')->group(function(){
        Route::get('/edit', 'PostsController@edit')->name('post.edit');
        Route::put('/update', 'PostsController@update')->name('post.update');
    });
<<<<<<< HEAD
});

Route::group(['middleware' => 'auth'], function (){
    Route::prefix('user/{id}')->group(function(){
=======
    Route::prefix('user/{user}')->group(function(){
>>>>>>> feature/jin/user_edit_update
        Route::get('/edit', 'UsersController@edit')->name('users.edit');
        Route::put('/update', 'UsersController@update')->name('users.update');
        Route::delete('/delete', 'UsersController@destroy')->name('users.destroy');
    });
});