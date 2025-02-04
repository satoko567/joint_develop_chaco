<?php

use App\Http\Controllers\FollowController;

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


// ユーザ登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');
// トップ投稿表示
Route::get('/', 'PostController@index')->name('post.list');


// ログイン・ログアウト
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

// ユーザ
Route::get('users/{id}', 'UsersController@show')->name('user.show');

// ログイン後
Route::group(['middleware' => 'auth'], function () {
    Route::prefix('posts')->group(function () {
        Route::get('{id}/edit', 'PostController@edit')->name('post.edit');
        Route::put('{id}', 'PostController@update')->name('post.update');
    });

    //フォロー
    Route::group(['prefix' => 'users/{id}'],function() {
        Route::post('follow', 'FollowController@follow')->name('follow');
        Route::post('unfollow', 'FollowController@unfollow')->name('unfollow');
        Route::get('followings', 'FollowController@showFollowings')->name('followings');
        Route::get('followers', 'FollowController@showFollowers')->name('followers');
    });


    // ユーザ退会
    Route::delete('users/{id}', 'UsersController@destroy')->name('user.delete');
});
