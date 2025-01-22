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

//トップ投稿表示


Route::get('/', 'PostController@index')->name('post.list');


// ログイン・ログアウト
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

// ユーザ
Route::get('users/{id}', 'UsersController@show')->name('user.show');

//ログイン後
Route::group(['middleware' => 'auth'], function () {
        Route::prefix('posts')->group(function () {
          Route::get('{id}/edit', 'PostController@edit')->name('post.edit');
          Route::put('{id}', 'PostController@update')->name('post.update');
        });
});