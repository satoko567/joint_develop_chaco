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

Route::get('/', 'PostsController@index')->name('posts.index');
Route::view('about', 'about.about')->name('about.show');

// 投稿詳細ページ
Route::get('post/{id}', 'PostsController@show')->name('posts.show');

// ユーザ新規登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

//ユーザ詳細
Route::get('users/{id}', 'UsersController@show')->name('user.show');

// ログイン
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

// ログイン後
Route::group(['middleware' => 'auth'], function () {
    // ユーザ編集、更新、退会
    Route::prefix('users/{id}')->group(function () {
        Route::get('edit', 'UsersController@edit')->name('user.edit');
        Route::put('', 'UsersController@update')->name('user.update');
        Route::delete('', 'UsersController@destroy')->name('user.delete');
    });
    // 新規投稿、編集、更新、削除
    Route::prefix('posts')->group(function () {
        Route::get('create', 'PostsController@create')->name('posts.create');
        Route::post('', 'PostsController@store')->name('posts.store');
        Route::delete('{id}', 'PostsController@destroy')->name('posts.delete');
        Route::get('{id}/edit', 'PostsController@edit')->name('posts.edit'); 
        Route::put('{id}', 'PostsController@update')->name('posts.update');
    }); 
    // レビュー
    Route::group(['prefix' => 'posts/{post_id}/reviews'], function () {
        Route::post('', 'ReviewsController@store')->name('reviews.store');
        Route::get('{review_id}/edit', 'ReviewsController@edit')->name('reviews.edit');
        Route::put('{review_id}', 'ReviewsController@update')->name('reviews.update');
    });
    Route::delete('reviews/{review_id}', 'ReviewsController@destroy')->name('reviews.delete');
    //フォロー・フォロー解除
    Route::group(['prefix' => 'users/{id}'], function () {
        Route::post('follow', 'FollowController@store')->name('follow');
        Route::delete('unfollow', 'FollowController@destroy')->name('unfollow');
    });
    //フォロー中・フォロワー一覧
    Route::get('users/{id}/followings', 'UsersController@followings')->name('users.followings');
    Route::get('users/{id}/followers', 'UsersController@followers')->name('users.followers');  
});