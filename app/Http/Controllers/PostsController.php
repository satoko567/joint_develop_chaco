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
        $posts = Post::orderBy('id','desc')->paginate(10);

        return view('posts.index',[
            'posts' => $posts,
        ]);
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
        $post->save(); //postテーブルに保存
        return back(); //投稿ボタンを押した後、投稿フォームに戻る
    }
}
