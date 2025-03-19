<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', 'PostsController@index');

// user新規登録処理
Route::prefix('/signup')->group(function () {
    Route::get('/', 'Auth\RegisterController@showRegistrationForm')->name('signup');
    Route::post('/','Auth\RegisterController@register')->name('signup.post');
});

// ログイン
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
//ログアウト
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

// user詳細
Route::prefix('/users')->group(function(){
    Route::get('/{id}','UsersController@show')->name('user.show');
});

// ユーザ詳細画面へ表示
Route::get('users/{user}', 'UsersController@show')->name('users.show');

// 編集フォームを表示
Route::get('users/{user}/edit', 'UsersController@edit')->name('users.edit');

// 更新処理
Route::put('users/{user}', 'UsersController@update')->name('users.update');

// 削除処理（退会用）
Route::delete('users/{user}', 'UsersController@destroy')->name('users.destroy');

// 投稿削除処理
Route::delete('posts/{post}', 'PostsController@destroy')->name('posts.destroy');

// 投稿編集画面表示
Route::get('posts/{post}/edit', 'PostsController@edit')->name('posts.edit');
