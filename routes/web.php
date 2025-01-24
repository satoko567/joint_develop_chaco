<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;

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

// 投稿関連
Route::get('/', 'PostsController@index')->name('home');

// ユーザー関連
Route::prefix('users')->group(function () {
    Route::get('/', [UsersController::class, 'index'])->name('users.index'); // ユーザー一覧
    Route::get('/{id}', [UsersController::class, 'show'])->name('users.show'); // ユーザー詳細
    Route::get('/{id}/following', [UsersController::class, 'following'])->name('users.following'); // フォロー中
    Route::get('/{id}/followers', [UsersController::class, 'followers'])->name('users.followers'); // フォロワー
});

// ユーザ新規登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

Route::group([ 'middleware' => 'auth' ], function(){
    Route::prefix('post/{id}')->group(function(){
        Route::get('/edit', 'PostsController@edit')->name('post.edit');
        Route::put('/update', 'PostsController@update')->name('post.update');
    });
    Route::prefix('user/{user}')->group(function(){
        Route::get('/edit', 'UsersController@edit')->name('users.edit');
        Route::put('/update', 'UsersController@update')->name('users.update');
        Route::delete('/delete', 'UsersController@destroy')->name('users.destroy');
    });
});
