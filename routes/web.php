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

// トップページの表示と検索機能
Route::get('/', 'SearchController@index')->name('search.index');

// ユーザ
Route::prefix('users')->group(function () {
    Route::get('{id}', 'UsersController@show')->name('user.show');
    Route::delete('{id}/delete', 'UsersController@destroy')->name('user.delete');
});
// ユーザ新規登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

Route::group(['middleware' => 'auth'], function () {
    Route::prefix('posts')->group(function () {
        // 投稿新規登録
        Route::post('', 'PostsController@store')->name('post.store');
        // 投稿編集画面表示
        Route::get('{id}/edit', 'PostsController@edit')->name('post.edit');
        // 投稿編集
        Route::put('{id}', 'PostsController@update')->name('post.update');
        // 投稿詳細画面表示
        Route::get('{id}/show', 'PostsController@show')->name('post.show');
        // コメント
        Route::post('{id}/comments', 'CommentController@store')->name('comments.store');
    });
});
// ログイン
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

// ユーザ編集・更新
Route::group(['middleware' => 'auth'], function () {
    Route::prefix('users')->group(function () {
        Route::get('{id}/edit', 'UsersController@edit')->name('user.edit');
        Route::put('{id}', 'UsersController@update')->name('user.update');
    });
});
