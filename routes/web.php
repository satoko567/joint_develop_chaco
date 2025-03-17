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

Route::get('/', 'PostsController@index');

// user新規登録処理
Route::prefix('/signup')->group(function () {
    Route::get('/', 'Auth\RegisterController@showRegistrationForm')->name('signup');
    Route::post('/','Auth\RegisterController@register')->name('signup.post');
});

Route::middleware('auth')->prefix('/users')->group(function(){
    // user詳細
    Route::get('/{id}','UsersController@show')->name('user.show');
    // user退会
    Route::delete('/','UsersController@destroy')->name('user.delete');
});
