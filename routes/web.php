<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// トップページ
Route::get('/', 'User\PostsController@index');
Route::get('/posts/search', 'User\PostsController@search')->name('posts.search');//検索機能をログインなしで
Route::get('/posts/{post}/replies', 'User\RepliesController@index')->name('replies.index');//リプライ一覧
Route::get('/posts/ranking', 'User\RankingController@index')->name('ranking.index');//ランキング表示

// ログイン必須のルーティング
Route::group(['middleware' => 'auth'], function () {

    // 投稿関係
    Route::prefix('/posts')->group(function(){
        Route::post('/', 'User\PostsController@store')->name('post.store'); // 新規投稿
        Route::delete('{id}', 'User\PostsController@destroy')->name('posts.destroy'); // 投稿削除
        Route::get('{id}/edit', 'User\PostsController@edit')->name('posts.edit'); // 編集画面
        Route::put('{id}', 'User\PostsController@update')->name('posts.update'); // 更新処理

        // リプライ機能
        Route::post('{post}/replies', 'User\RepliesController@store')->name('replies.store'); // リプライ投稿

        // リプライ編集・更新・削除
    Route::prefix('replies/{reply}')->group(function () {
        Route::get('edit', 'User\RepliesController@edit')->name('replies.edit'); //リプライ編集画面
        Route::put('/', 'User\RepliesController@update')->name('replies.update'); //リプライ編集
        Route::delete('/', 'User\RepliesController@destroy')->name('replies.destroy'); //リプライ削除
    });

        // いいね機能の追加
        Route::post('{id}/like', 'User\LikeController@like')->name('posts.like'); // いいね
        Route::delete('{id}/unlike', 'User\LikeController@unlike')->name('posts.unlike'); // いいね解除
    });

    // ユーザ関係(ログイン必要)
    Route::prefix('/users')->group(function(){
        Route::get('{user}/edit', 'User\UsersController@edit')->name('users.edit'); // ユーザ編集
        Route::put('{user}', 'User\UsersController@update')->name('users.update'); // ユーザ更新
        Route::delete('/{id}', 'User\UsersController@destroy')->name('users.destroy'); // ユーザ削除

        // ユーザフォロー関係(ログイン必要)
        Route::post('follow/{id}','User\FollowsController@follow')->name('user.follow'); // フォロー処理
        Route::delete('unfollow/{id}','User\FollowsController@unfollow')->name('user.unfollow'); // フォロー解除処理
    });
});

// 管理者ログインページ
Route::get('/admin/login', 'Admin\LoginController@showLoginForm')->name('admin.show.login'); // 管理者ログイン画面表示
Route::post('/admin/login', 'Admin\LoginController@login')->name('admin.login.post'); // 管理者ログイン処理


// 管理者関係
Route::group(['middleware' => 'admin'], function(){

    Route::prefix('/admin')->group(function(){
        Route::get('/', 'Admin\LoginController@showDashboard')->name('admin.show.dashboard'); // 管理者画面表示
        Route::get('/users', 'Admin\UsersController@showUsers')->name('admin.show.users'); // ユーザ編集画面表示 + 検索機能
        Route::get('/posts', 'Admin\PostsController@showPosts')->name('admin.show.posts'); // 投稿編集画面表示 + 検索機能
        Route::get('/replies', 'Admin\RepliesController@showReply')->name('admin.show.replies'); // リプライ編集画面 + 検索機能
        Route::post('/users/{id}/toggle', 'Admin\UsersController@updateUser')->name('admin.users.update'); // ユーザ権限変更
        Route::delete('/users/{id}', 'Admin\UsersController@destroyUser')->name('admin.users.destroy'); // ユーザ削除
        Route::delete('/posts/{id}', 'Admin\PostsController@destroyPost')->name('admin.posts.destroy'); // 投稿削除
        Route::delete('/replies/{id}', 'Admin\RepliesController@destroyReply')->name('admin.replies.destroy'); // リプライ削除
    });
});

// ユーザー関係（ログイン不要）
Route::prefix('/users')->group(function(){
    Route::get('/{id}','User\UsersController@show')->name('user.show'); // ユーザ詳細

    // ユーザフォロー関係(ログイン不要)
    Route::get('following/{id}','User\FollowsController@followingList')->name('list.following'); // フォローリスト表示
    Route::get('follower/{id}','User\FollowsController@FollowerList')->name('list.follower'); // フォロワーリスト表示
});

// ユーザ登録関係
Route::prefix('/signup')->group(function () {
    Route::get('/', 'Auth\RegisterController@showRegistrationForm')->name('signup'); // 登録画面表示
    Route::post('/', 'Auth\RegisterController@register')->name('signup.post'); // 登録処理
});

// ログイン・ログアウト
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login'); // ログイン画面表示
Route::post('login', 'Auth\LoginController@login')->name('login.post'); // ログイン処理
Route::get('logout', 'Auth\LoginController@logout')->name('logout'); // ログアウト
