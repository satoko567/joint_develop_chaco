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
    // 以下、ログイン後のみ実行できるルーティングを記述可能

    Route::prefix('/users')->group(function(){
        Route::delete('/{id}','UsersController@destroy')->name('user.destroy'); // ユーザ退会

        Route::post('follow/{id}','FollowController@follow')->name('user.follow'); // フォロー処理
        Route::delete('unfollow/{id}','FollowController@unfollow')->name('user.unfollow'); //フォロー解除処理
        // 以下、【ログイン後に実行可能な】その他のUser関連のルーティングを記述可能
    });

    // 投稿関係
    Route::prefix('/posts')->group(function(){
        Route::post('/', 'PostsController@store')->name('post.store');
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
    Route::get('/{id}','UsersController@show')->name('user.show'); // ユーザ詳細

    Route::get('following/{id}','FollowController@followingList')->name('list.following'); // フォローリスト表示
    Route::get('follower/{id}','FollowController@FollowerList')->name('list.follower'); // フォロワーリスト表示
    // 以下、【ログインが不必要な】その他のUser関連のルーティングを記述可能
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
