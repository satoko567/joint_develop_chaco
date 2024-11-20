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
    Route::prefix('users/{id}')->group(function () {
        Route::get('edit', 'UsersController@edit')->name('user.edit');
        Route::put('/', 'UsersController@update')->name('user.update');
    });
});
//トップページの表示
Route::get('/', 'PostsController@index');

//検索機能
Route::get('/posts', 'PostsController@search')->name('search.index');

// ユーザ新規登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');