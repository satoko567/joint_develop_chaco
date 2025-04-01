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

//ログイン後
//    Route::group(['middleware' => 'auth'], function () {
    //新規投稿
        Route::get('post', 'PostingController@showPostingForm')->name('post');
        Route::post('post', 'PostingController@store')->name('post.store');
    //ユーザ詳細画面
    Route::get('users/{id}', 'UsersController@show')->name('user.show');
//    });





