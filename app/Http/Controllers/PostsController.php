<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\User;
use App\Post;

class PostsController extends Controller
{
    // ユーザとその投稿一覧を表示するメソッド
    public function index()
    {
        return view('posts.index');
    }

    /**
     * 投稿フォームを表示するメソッド
     *
     * @return \Illuminate\Http\Response
     */
    public function showPostingForm()
    {
        $user = \Auth::user();
        $data = [
            'user' => $user,
        ];
        return view('posts.new_post_form', $data);
    }

    /**
     * 投稿データを、postsテーブルに保存するメソッド
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $post = new Post(); //Postモデルのインスタンスを作成＝postsテーブルに、新規レコードを作成
        $post->content = $request->content; //投稿内容をpostテーブルのcontentカラムに代入
        $post->user_id = $request->user()->id; //ログインユーザのidを、postテーブルのuser_idカラムに代入。user・postテーブルのリレーションを作る必要。ログインしてないと、user()はnullを返すから注意！
        $post->created_at = now(); //現在時刻をpostテーブルのcreated_atカラムに代入
        $post->updated_at = now(); //現在時刻をpostテーブルのupdated_atカラムに代入
        $post->save(); //postテーブルに保存
        return back(); //投稿ボタンを押した後、投稿フォームに戻る
    }
}