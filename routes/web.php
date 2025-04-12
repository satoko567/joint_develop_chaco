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

//トップページ
Route::get('/', 'PostsController@index')->name('index');

//ユーザ新規登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

//ログイン
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

//ユーザ詳細画面
Route::get('users/{id}', 'UsersController@show')->name('users.show');

//ログイン後
Route::group(['middleware' => 'auth'], function () {
    //新規投稿
    Route::post('post', 'PostsController@store')->name('post.store');

    //ユーザの編集
    Route::prefix('users')->group(function () {
        //ユーザ情報の編集
        Route::get('{id}/edit', 'UsersController@edit')->name('users.edit');
        //ユーザ削除
        Route::delete('{id}', 'UsersController@delete')->name('users.delete');
    });

    //フォロー
    Route::post('follow/{id}', 'FollowsController@store')->name('follow.store');
    Route::delete('unfollow/{id}', 'FollowsController@delete')->name('follow.delete');
});






