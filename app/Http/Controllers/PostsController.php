<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Http\Requests\PostRequest;
use App\Http\Requests\SearchRequest;

class PostsController extends Controller
{
    public function index(SearchRequest $request)
    {
        $keyword = $request->input('keyword');
        $posts = Post::when($keyword, function ($query, $keyword) {
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

    public function store(PostRequest $request)
    {
         $post = new Post;
         $post->content = $request->content;
         $post->user_id = $request->user()->id;
         $post->save();
        
         return back();
    }
    
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        if (\Auth::id() !== $post->user_id) {
            return redirect()->back()->with('error', 'この投稿を削除する権限がありません。');
        }
        try {
            $post->deleteWithReplies(); 
            return redirect()->back()->with('success', '投稿を削除しました。');
        } 
        catch (\Exception $e) {
            return redirect()->back()->with('error', '投稿の削除中にエラーが発生しました。');
        }
    }