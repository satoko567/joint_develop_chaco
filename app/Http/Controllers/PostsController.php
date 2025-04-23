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
        $data = [ //現状、viewに渡す変数は１個。だが、今後の拡張性を考えて、配列で書いておく。
            'posts' => $posts, //index.bladeで、$postsと書いて使う。この中身は、ここで定義してある$posts。
        ];
        return view('posts.index', $data); //posts.indexビューを表示
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

    public function edit($id) //編集ボタンを押した投稿データの、idを取得
    {
        $post = Post::findOrFail($id); //選択した投稿に該当する、投稿データを取得。
        if (\Auth::id() === $post->user_id) { //自分の投稿以外は編集できないようにする。そのために、ログインユーザのidと、投稿データのidが一致しない場合はエラーを出す。
            $data = [
                'post' => $post,
            ];
            return view('posts.edit_post_form', $data); //posts.editビューを表示
        }
        abort(404); //404エラーを返す。
    }

    public function update(PostRequest $request, $id)
    {
        $post = Post::findOrFail($id); //idに該当する投稿データを取得。見つからなければ404エラーを返す
        $post->content = $request->content; //投稿内容をpostテーブルのcontentカラムに代入
        $post->save(); //postテーブルに保存
        return redirect('/'); //投稿ボタンを押した後、トップページにリダイレクト
    }
}
