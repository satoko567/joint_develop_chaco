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
//ユーザ新規登録
Route::get('/signup', 'UsersController@showRegisterForm')->name('signup.get');
Route::post('/signup', 'UsersController@store')->name('signup.post');
