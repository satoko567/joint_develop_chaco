<?php

use Illuminate\Support\Facades\Route;
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

Route::get('/', 'PostsController@index');
// 投稿処理
Route::group(['middleware' => 'auth'], function(){
    // 以下、ログイン後のみ実行できるルーティングを記述可能
    Route::prefix('/posts')->group(function(){
        Route::post('/','PostsController@store')->name('post.store'); // 新規登録処理
        // 以下、その他post関連のルーティングを記述可能
    });
});

// user新規登録処理
Route::prefix('/signup')->group(function () {
    Route::get('/', 'Auth\RegisterController@showRegistrationForm')->name('signup'); // 画面表示
    Route::post('/','Auth\RegisterController@register')->name('signup.post'); // 登録処理
});

// user詳細
Route::prefix('/users')->group(function(){
    Route::get('/{id}','UsersController@show')->name('user.show');
});
