<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', 'PostsController@index');

Route::group(['middleware' => 'auth'], function(){

    // 投稿関係
    Route::prefix('/posts')->group(function(){
        Route::post('/','PostsController@store')->name('post.store'); //新規登録
    });

    // ユーザー編集・更新
    Route::prefix('/users')->group(function(){
        Route::get('{user}/edit', 'UsersController@edit')->name('users.edit');
        Route::put('{user}', 'UsersController@update')->name('users.update');
    });

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

// user詳細
Route::prefix('/users')->group(function(){
    // ユーザ詳細
    Route::get('/{id}','UsersController@show')->name('user.show');
});

// 編集フォームを表示
Route::get('users/{user}/edit', 'UsersController@edit')->name('users.edit');

// 更新処理
Route::put('users/{user}', 'UsersController@update')->name('users.update');

//一旦書く
Route::delete('users/{user}', 'UsersController@destroy')->name('users.destroy');





