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

Route::get('/', 'PostsController@index')->name('index');

// ユーザ
Route::prefix('users')->group(function () {
    Route::get('{id}', 'UsersController@show')->name('user.show');
});
// ユーザ新規登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');



Route::group(['middleware' => 'auth'], function () {
    Route::prefix('posts')->group(function () {
        // 投稿編集画面表示
        Route::get('{id}/edit', 'PostsController@edit')->name('post.edit');
        // 投稿編集
        Route::put('{id}', 'PostsController@update')->name('post.update');
    });
});