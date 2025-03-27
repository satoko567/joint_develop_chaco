<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// トップページ
Route::get('/', 'PostsController@index');

// ログイン必須のルーティング
Route::group(['middleware' => 'auth'], function(){

    // 投稿関係
    Route::prefix('/posts')->group(function(){
        Route::post('/', 'PostsController@store')->name('post.store');
        Route::delete('{id}', 'PostsController@destroy')->name('posts.destroy');
        Route::get('{id}/edit', 'PostsController@edit')->name('posts.edit'); // 編集画面を表示
        Route::put('{id}', 'PostsController@update')->name('posts.update'); // 更新処理
    });

    // ユーザー編集・更新・削除
    Route::prefix('/users')->group(function(){
        Route::get('{user}/edit', 'UsersController@edit')->name('users.edit');
        Route::put('{user}', 'UsersController@update')->name('users.update');
        Route::delete('/{id}', 'UsersController@destroy')->name('users.destroy');

    });

});

// ユーザー詳細（ログイン不要）
Route::prefix('/users')->group(function(){
    Route::get('/{id}', 'UsersController@show')->name('user.show');
});

// ユーザー登録
Route::prefix('/signup')->group(function(){
    Route::get('/', 'Auth\RegisterController@showRegistrationForm')->name('signup');
    Route::post('/', 'Auth\RegisterController@register')->name('signup.post');
});

// ログイン・ログアウト
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
