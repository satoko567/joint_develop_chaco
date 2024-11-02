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

<<<<<<< HEAD
//ログイン
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post'); //フォームに入力されたデータを実行
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
=======
Route::get('/', 'PostsController@index');
>>>>>>> 08b01a2e607ffc52f22a4287e4c4f13dc3d2e55f
