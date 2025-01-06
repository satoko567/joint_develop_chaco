<?php
use App\Http\Controllers\PostController;

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

//トップ投稿表示


Route::get('/', 'PostController@index')->name('post_list');

//postの本人確認
Route::resource('posts', PostController::class)->middleware('auth');

