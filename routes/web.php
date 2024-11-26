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

//ログイン
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post'); //フォームに入力されたデータを実行
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

// ログイン後
Route::group(['middleware' => 'auth'], function () {
    Route::delete('posts/{id}', 'PostsController@destroy')->name('post.delete'); //ユーザ削除
    Route::prefix('users/{id}')->group(function () {
        Route::get('edit', 'UsersController@edit')->name('user.edit');
        Route::put('/', 'UsersController@update')->name('user.update');
        // ユーザ詳細
        Route::get('/', 'UsersController@show')->name('user.show');
    });
});

//トップページの表示
Route::get('/', 'PostsController@index');

// ユーザ新規登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

// 新規投稿
Route::group(['middleware' => 'auth'], function () {
    Route::prefix('posts')->group(function () {
        Route::post('', 'PostsController@store')->name('post.store');
        // 投稿編集画面
        Route::get('{id}/edit', 'PostsController@edit')->name('post.edit');
        // 投稿更新
        Route::put('{id}', 'PostsController@update')->name('post.update');
    });
});