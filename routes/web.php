<?php

use App\Http\Controllers\UsersController;
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
Route::group(['middleware' => 'auth'], function(){
    // 以下、ログイン後のみ実行できるルーティングを記述可能

    Route::prefix('/users')->group(function(){
        Route::delete('/{id}','UsersController@destroy')->name('user.destroy'); // ユーザ退会

        Route::post('follow/{id}','FollowController@follow')->name('user.follow'); // フォロー処理
        Route::post('unfollow/{id}','FollowController@unfollow')->name('user.unfollow'); //フォロー解除処理
        // 以下、【ログイン後に実行可能な】その他のUser関連のルーティングを記述可能
    });

    Route::prefix('/posts')->group(function(){
        Route::post('/','PostsController@store')->name('post.store'); // 新規登録処理
        // 以下、その他post関連のルーティングを記述可能
    });

});

Route::prefix('/users')->group(function(){
    Route::get('/{id}','UsersController@show')->name('user.show'); // ユーザ詳細

    Route::get('following/{id}','FollowController@followingList')->name('list.following'); // フォローリスト表示
    Route::get('follower/{id}','FollowController@FollowerList')->name('list.follower'); // フォロワーリスト表示
    // 以下、【ログインが不必要な】その他のUser関連のルーティングを記述可能
});

// user新規登録処理
Route::prefix('/signup')->group(function () {
    Route::get('/', 'Auth\RegisterController@showRegistrationForm')->name('signup'); // 画面表示
    Route::post('/','Auth\RegisterController@register')->name('signup.post'); // 登録処理
});

// ログイン
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
//ログアウト
Route::get('logout', 'Auth\LoginController@logout')->name('logout');