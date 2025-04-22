<?php

namespace App\Http\Controllers;

use App\Post;
use App\Reply;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // 管理者画面表示
    public function showDashboard()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(10);
        $posts = Post::orderBy('created_at', 'desc')->paginate(10);
        $replies = Reply::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.dashboard', compact('users', 'posts', 'replies'));
    }

    //ユーザ編集画面表示 + 検索機能
    public function showUsers(Request $request)
    {
        $query  = User::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        if ($request->filled('is_admin')) {
            $query->where('is_admin', $request->input('is_admin'));
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.users', compact('users'));
    }

    //投稿編集画面表示 + 検索機能
    public function showPosts(Request $request)
    {
        $keyword = $request->input('keyword');
        $query = Post::with('user');

        if (!empty($keyword)) {
            $query->where(function ($q) use ($keyword) {
                $q->where('content', 'like', '%' . $keyword . '%')
                    ->orWhereHas('user', function ($q2) use ($keyword) {
                        $q2->where('name', 'like', '%' . $keyword . '%');
                    });
            });
        }

        $posts = $query->orderBy('created_at', 'desc')->paginate(10);
        $users = User::all();

        return view('admin.posts', compact('posts', 'users', 'keyword'));
    }

    //リプライ編集画面表示 + 検索機能
    public function showReplies(Request $request)
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

    // 管理者権限切替
    public function updateUser($id)
    {
        $user = User::findOrFail($id);
        $user->is_admin = !$user->is_admin;
        $user->save();

        return back();
    }

    // ユーザ削除
    public function destroyUser($id)
    {
        User::destroy($id);

        return back();
    }

    //投稿削除
    public function destroyPost($id)
    {
        Post::destroy($id);

        return back();
    }

    // リプライ削除
    public function destroyReplies($id)
    {
        Reply::destroy($id);

        return back();
    }
}
