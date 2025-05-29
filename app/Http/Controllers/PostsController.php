<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Reply;
use App\Http\Requests\PostRequest;
use App\Http\Requests\SearchRequest;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    public function index(SearchRequest $request)
    {
        $keyword = $request->input('keyword');
        $posts = Post::withCount('replies')
            ->when($keyword, function ($query, $keyword) {
                return $query->where('content', 'like', "%{$keyword}%");
            })
            ->orderBy('id', 'desc')
            ->paginate(10);
        $data = [
            'keyword' => $keyword,
            'posts' => $posts,
        ];
        return view('welcome', $data);
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        $post->load('user');
        $replies = $post->replies()->with('user')->orderBy('id', 'desc')->paginate(10);
        $latestReply = Reply::latestReply($post);
        $hasReplied = false;
        if (Auth::check()) {
            if (Auth::id() !== $post->user_id) {
                $hasReplied = Reply::hasReplied(Auth::user(), $post);
            }
        }
        $data = [
            'post' => $post,
            'replies' => $replies,
            'latestReply' => $latestReply,
            'hasReplied' => $hasReplied,
        ];
        $data += Reply::replyCounts($post);
        return view('posts.show', $data);
    }

    public function store(PostRequest $request)
    {
         $post = new Post;
         $post->content = $request->content;
         $post->user_id = $request->user()->id;
         $post->save();

         return back();
    }

    // 清水さんへ
    // 投稿削除処理（destroyメソッド）をこのコントローラーに実装していただく際に、
    // 投稿と一緒にリプライも論理削除されるように、
    // 「$post->deleteWithReplies();」を記載していただけるとありがたいです。
    // 清水さんのコードと合わせると下記のようになるかと思います。
    // ※下記コードで動作確認完了

    // public function destroy($id)
    // {
    //     $post = Post::findOrFail($id);
    //     if (\Auth::id() === $post->user_id) {
    //         $post->delete();
    //     }
    //     $post->deleteWithReplies();　←これを追加
    //     return redirect()->back();
    // }

    // 理由：
    // Postモデルに以下のメソッドを記載しており、
    // 投稿を削除する際に、リプライも一緒に削除される仕組みになっています。
    // public function deleteWithReplies()
    // {
    //     $this->replies()->delete();
    //     $this->delete();
    // }
    // このメソッドを使わない場合、投稿だけ削除されてリプライがデータベースに残ってしまいます。
    // お手数をおかけして、申し訳ございません。
    // もし分からなければ、後で私の方で、リプライの修正ブランチを作成し、「$post->deleteWithReplies();」を
    // 後で記載いたしますので、ご心配には及びません。
    // ご不明点があれば、聞いてくださいね！
    // ※※※「$post->deleteWithReplies();」を追記したらこのコメントアウトは削除してください ※※※
}