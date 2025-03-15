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

// user新規登録処理
Route::prefix('/signup')->group(function () {
    Route::get('/', 'Auth\RegisterController@showRegistrationForm')->name('signup');
    Route::post('/','Auth\RegisterController@register')->name('signup.post');
});

<<<<<<< HEAD
// ログイン
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
//ログアウト
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
=======
//user詳細
Route::prefix('/users')->group(function(){
    Route::get('/{id}','UsersController@show')->name('user.show');
});
>>>>>>> 78cb0fcc0953e1d48b3f8db5f6caf5eaa569fdbf
