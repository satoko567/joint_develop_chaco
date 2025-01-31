<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PostsController;

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

// ユーザー関連
Route::get('/', 'PostsController@index')->name('home');
Route::get('users/{id}', [UsersController::class, 'show'])->name('users.show'); // ユーザー詳細

// ユーザ新規登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

// ログイン
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

//新規投稿
Route::post('/posts', [PostsController::class, 'store'])->name('posts.store');

Route::group([ 'middleware' => 'auth' ], function(){
    Route::prefix('post/{id}')->group(function(){
        Route::get('/edit', 'PostsController@edit')->name('post.edit');
        Route::put('/update', 'PostsController@update')->name('post.update');
        Route::delete('/delete', 'PostsController@destroy')->name('posts.destroy');
    });
    Route::prefix('user/{user}')->group(function(){
        Route::get('/edit', 'UsersController@edit')->name('users.edit');
        Route::put('/update', 'UsersController@update')->name('users.update');
        Route::delete('/delete', 'UsersController@destroy')->name('users.destroy');
        Route::get('/following', 'FollowController@following')->name('users.following');
        Route::get('/followers', 'FollowController@followers')->name('users.followers');
        Route::post('/follow', 'FollowController@follow')->name('follow');
        Route::delete('/unfollow', 'FollowController@unfollow')->name('unfollow');
    });

}); 

