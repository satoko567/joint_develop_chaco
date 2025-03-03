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

Route::get('/', function () {
    return view('welcome');
});

// user新規登録処理
Route::prefix('/register')->group(function () {
    Route::get('/', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('/','Auth\RegisterController@register')->name('post.register');
});