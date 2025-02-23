<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\UserProfileController;
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
Route::get('users/{id}', [UsersController::class, 'timeline'])->name('users.show'); //'timeline'を'show'に戻せば本来のユーザー詳細となる。

// ユーザ新規登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

//コメント一覧表示
Route::get('post/{id}/comments', 'CommentsController@index')->name('posts.comment');

// ログイン
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

//新規投稿
Route::group(['middleware' => 'auth'], function () {
    Route::post('/posts', [PostsController::class, 'store'])->name('posts.store');
    Route::prefix('post/{id}')->group(function () {
        Route::get('/edit', 'PostsController@edit')->name('post.edit');
        Route::put('/update', 'PostsController@update')->name('post.update');
        Route::delete('/delete', 'PostsController@destroy')->name('posts.destroy');
        Route::post('/comment', 'CommentsController@store')->name('comments.store');//コメント投稿・返信
    });
    Route::get('/comment/{commentId}/edit', 'CommentsController@edit')->name('comment.edit');//コメント編集
    Route::put('/comment/{commentId}/update', 'CommentsController@update')->name('comment.update');//コメント更新
    Route::delete('/comment/{commentId}/delete', 'CommentsController@destroy')->name('comment.destroy');//コメント削除

    Route::prefix('user/{user}')->group(function () {
        Route::get('/edit', 'UsersController@edit')->name('users.edit');
        Route::put('/update', 'UsersController@update')->name('users.update');
        Route::delete('/delete', 'UsersController@destroy')->name('users.destroy');
        Route::post('/user/upload-icon', [UsersController::class, 'uploadIcon'])->name('users.uploadIcon');
        Route::get('/following', 'FollowController@following')->name('users.following');
        Route::get('/followers', 'FollowController@followers')->name('users.followers');
        Route::post('/follow', 'FollowController@follow')->name('follow');
        Route::delete('/unfollow', 'FollowController@unfollow')->name('unfollow');
        Route::get('/notice', 'CommentsController@notice')->name('user.notice');//レスポンス
    });
});
