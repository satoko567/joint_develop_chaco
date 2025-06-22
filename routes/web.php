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
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

Route::get('/ranking/followers', 'UsersController@followerRanking')->name('ranking.followers');

Route::prefix('users/{id}')->group(function () {
    Route::get('', 'UsersController@show')->name('user.show');
    Route::get('follows', 'UsersController@follows')->name('user.follows');
    Route::get('followers', 'UsersController@followers')->name('user.followers');
});

Route::group(['middleware' => 'auth'], function () {
    Route::prefix('posts')->group(function () {
        Route::prefix('{post_id}/replies/{reply}')->group(function () {
            Route::get('edit', 'RepliesController@edit')->name('replies.edit');
            Route::put('/', 'RepliesController@update')->name('replies.update');
        });
        Route::post('', 'PostsController@store')->name('posts.store');
        Route::get('{id}/edit', 'PostsController@edit')->name('post.edit');
        Route::put('{id}', 'PostsController@update')->name('post.update');
        Route::delete('{id}', 'PostsController@destroy')->name('post.destroy');
        Route::post('{id}/replies', 'RepliesController@store')->name('replies.store');
    });

    Route::prefix('users')->group(function () {
        Route::get('{id}/edit', 'UsersController@edit')->name('user.edit');
        Route::put('{id}', 'UsersController@update')->name('user.update');
        Route::delete('{id}', 'UsersController@withdrawal')->name('user.withdrawal');
    });

    Route::group(['prefix' => 'users/{id}'], function() {
        Route::post('follow', 'FollowController@store')->name('follow');
        Route::delete('unfollow', 'FollowController@destroy')->name('unfollow');
    });
    
});   
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/', 'PostsController@index')->name('post.index');
Route::get('posts/{id}', 'PostsController@show')->name('post.show');

// タグ
Route::get('/tags/{id}', 'TagController@search')->name('tags.search');
