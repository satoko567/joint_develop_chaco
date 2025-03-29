<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\User;
use App\Post;

class PostingController extends Controller
{
    // ユーザとその投稿一覧を表示するメソッド
    public function index()
    {
        return view('users.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showPostingForm()
    {
        $user = \Auth::user();
        $data = [
            'user' => $user,
        ];
        return view('new_post_form', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
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
        $post->delete_flg = 0; //postテーブルのdelete_flgカラムに0を代入
        $post->save(); //postテーブルに保存
        return redirect('post')->with('flash_message', __('Registered.')); //投稿ボタンを押すと、投稿ページにリダイレクトされ、フラッシュメッセージが表示される
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
}
