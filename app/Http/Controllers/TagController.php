<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;

class TagController extends Controller
{
    public function search($id)
    {
        $tag = Tag::findOrFail($id);
        $posts = $tag->posts()->with('user', 'tags')->latest()->paginate(10);

        return view('tags.search', compact('tag', 'posts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:tags,name',
        ]);

        Tag::create(['name' => trim($request->name)]);

        return redirect()->back()->with('success', 'タグを追加しました！');
    }

    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);

        // 関連する投稿がある場合は削除不可（任意でチェック）
        if ($tag->posts()->exists()) {
            return back()->with('error', '投稿に使われているタグは削除できません。');
        }

        $tag->posts()->detach();
        $tag->delete(); // 物理削除

        return back()->with('success', 'タグを削除しました');
    }

}
