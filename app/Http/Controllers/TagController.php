<?php

namespace App\Http\Controllers;

use App\Tag;

class TagController extends Controller
{   
    //タグボタンを押したら、そのタグが含まれる投稿を一覧表示する
    public function show($id)
    {
        $tag = Tag::findOrFail($id);
        $posts = $tag->posts()->latest()->paginate(10);

        return view('tags.show', [
            'tag' => $tag,
            'posts' => $posts,
        ]);
    }
}
