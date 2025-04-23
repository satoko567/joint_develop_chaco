<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Reply;
use App\Post;

class RepliesController extends Controller
{
    //リプライ編集画面表示 + 検索機能
    public function showReply(Request $request)
    {
        $keyword = $request->input('keyword');
        $query = Reply::with(['user', 'post']);

        if (!empty($keyword)) {
            $query->where(function ($q) use ($keyword) {
                $q->where('content', 'like', '%' . $keyword . '%')
                    ->orWhereHas('user', function ($q2) use ($keyword) {
                        $q2->where('name', 'like', '%' . $keyword . '%');
                    });
            });
        }

        $replies = $query->orderBy('created_at', 'desc')->paginate(10);
        $posts = Post::with('user')->get();

        return view('admin.replies', compact('replies', 'posts', 'keyword'));
    }

    // リプライ削除
    public function destroyReply($id)
    {
        Reply::destroy($id);

        return back();
    }
}
