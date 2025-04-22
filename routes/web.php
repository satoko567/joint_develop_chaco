<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// トップページ
Route::get('/', 'PostsController@index');
Route::get('/posts/search', 'PostsController@search')->name('posts.search');//検索機能をログインなしで
Route::get('/posts/{post}/replies', 'RepliesController@index')->name('replies.index');//リプライ一覧
Route::get('/posts/ranking', 'RankingController@index')->name('ranking.index');//ランキング表示


// ログイン必須のルーティング
Route::group(['middleware' => 'auth'], function(){

    // 投稿関係
    Route::prefix('/posts')->group(function(){
        Route::post('/', 'PostsController@store')->name('post.store'); // 新規投稿
        Route::delete('{id}', 'PostsController@destroy')->name('posts.destroy'); // 投稿削除
        Route::get('{id}/edit', 'PostsController@edit')->name('posts.edit'); // 編集画面を表示
        Route::put('{id}', 'PostsController@update')->name('posts.update'); // 更新処理
        Route::post('{post}/replies', 'RepliesController@store')->name('replies.store'); //リプライ投稿
        Route::get('/replies/{reply}/edit', 'RepliesController@edit')->name('replies.edit');// リプライ編集画面の表示
        Route::put('/replies/{reply}', 'RepliesController@update')->name('replies.update');// リプライの更新処理


        // いいね機能の追加
        Route::post('{id}/like', 'LikeController@like')->name('posts.like'); // いいね
        Route::delete('{id}/unlike', 'LikeController@unlike')->name('posts.unlike'); // いいね解除
    });

    // ユーザ関係(ログイン必要)
    Route::prefix('/users')->group(function(){
        Route::get('{user}/edit', 'UsersController@edit')->name('users.edit'); // ユーザ編集
        Route::put('{user}', 'UsersController@update')->name('users.update'); // ユーザ更新
        Route::delete('/{id}', 'UsersController@destroy')->name('users.destroy'); // ユーザ削除

        // ユーザフォロー関係(ログイン必要)
        Route::post('follow/{id}','FollowsController@follow')->name('user.follow'); // フォロー処理
        Route::delete('unfollow/{id}','FollowsController@unfollow')->name('user.unfollow'); // フォロー解除処理
    });

});

// 管理者関係
Route::group(['middleware' => 'admin'], function(){

    Route::prefix('/admin')->group(function(){
        Route::get('/', 'AdminController@showDashboard')->name('admin.show.dashboard'); // 管理者画面表示
        Route::get('/users', 'AdminController@showUsers')->name('admin.show.users'); // ユーザ編集画面表示 + 検索機能
        Route::get('/posts', 'AdminController@showPosts')->name('admin.show.posts'); // 投稿編集画面表示 + 検索機能
        Route::get('/replies', 'AdminController@showReplies')->name('admin.show.replies'); // リプライ編集画面 + 検索機能
        Route::post('/users/{id}/toggle', 'AdminController@updateUser')->name('admin.users.update'); // ユーザ権限変更
        Route::delete('/users/{id}', 'AdminController@destroyUser')->name('admin.users.destroy'); // ユーザ削除
        Route::delete('/posts/{id}', 'AdminController@destroyPost')->name('admin.posts.destroy'); // 投稿削除
        Route::delete('/replies/{id}', 'AdminUser@destroyReplies')->name('admin.replies.destroy'); // リプライ削除
    });
});

// ユーザー関係（ログイン不要）
Route::prefix('/users')->group(function(){
    Route::get('/{id}','UsersController@show')->name('user.show'); // ユーザ詳細

    // ユーザフォロー関係(ログイン不要)
    Route::get('following/{id}','FollowsController@followingList')->name('list.following'); // フォローリスト表示
    Route::get('follower/{id}','FollowsController@FollowerList')->name('list.follower'); // フォロワーリスト表示
});

// ユーザ登録関係
Route::prefix('/signup')->group(function(){
    Route::get('/', 'Auth\RegisterController@showRegistrationForm')->name('signup'); // 登録画面表示
    Route::post('/', 'Auth\RegisterController@register')->name('signup.post'); // 登録処理
});

// ログイン・ログアウト
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login'); // ログイン画面表示
Route::post('login', 'Auth\LoginController@login')->name('login.post'); // ログイン処理
Route::get('logout', 'Auth\LoginController@logout')->name('logout'); // ログアウト
