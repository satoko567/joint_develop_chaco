<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\User;
use App\Post;
use App\Tag;

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
        // 投稿の保存処理*******************************************************************************************************************
        $post = new Post(); //Postモデルのインスタンスを作成＝postsテーブルに、新規レコードを作成
        $post->content = $request->content; //投稿内容をpostテーブルのcontentカラムに代入
        $post->user_id = $request->user()->id; //ログインユーザのidを、postテーブルのuser_idカラムに代入。user・postテーブルのリレーションを作る必要。ログインしてないと、user()はnullを返すから注意！
        $post->save(); //postテーブルに保存
        //*******************************************************************************************************************

        // タグの保存処理*******************************************************************************************************************
        // タグ処理開始
        $tagNamesRaw = explode(',', $request->input('tags', ''));
        
        // ① 前処理（trimのみ）→ 重複・空白除去
        $cleanedNames = collect($tagNamesRaw)
            ->map('trim')        // 前後の空白除去
            ->filter()           // 空文字除去
            ->unique()
            ->values();          // インデックス再構成

        if ($cleanedNames->isEmpty()) {
            return back();
        }

        // ②既存のタグを一括取得（1回のSELECT）
        $existingTags = Tag::whereIn('name', $cleanedNames)->get();

        // ③既存名の一覧
        $existingNames = $existingTags->pluck('name');

        // ④DBに存在しない新規タグ名のみ抽出
        $newTagNames = $cleanedNames->diff($existingNames);

        // ⑤新規タグを一括でINSERT（1回のINSERT）
        $insertData = $newTagNames->map(function ($name) {
            return [
                'name' => $name,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        });

        if ($insertData->isNotEmpty()) {
            Tag::insert($insertData->all());
        }

        // ⑥再度全タグを取得して、関連付け用のIDリストを作る（最終的に1回のSELECT）
        $allTags = Tag::whereIn('name', $cleanedNames)->get();
        $tagIds = $allTags->pluck('id');

        // ⑦中間テーブルへの関連付け（1回のsync）
        $post->tags()->sync($tagIds);

        return back();
        //*******************************************************************************************************************
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

    public function search(Request $request)
    {
        $keyword = $request->input('search_content'); //検索ボックスに入力された値を取得
        $query = Post::query();

        if (!empty($keyword)) {
            // 半角/全角スペースで複数ワードを分割
            $words = preg_split('/[\s　]+/u', $keyword);

            foreach ($words as $word) {
                if (trim($word) !== '') {
                    $query->where('content', 'like', '%' . $word . '%');
                }
            }
        }

        $posts = $query->with('user')->orderBy('created_at', 'desc')->paginate(10);

        return view('posts.index', [
            'posts' => $posts,
            'keyword' => $keyword, // ハイライト用
        ]);
    }

}
