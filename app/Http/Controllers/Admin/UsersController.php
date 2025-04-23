<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Post;

class UsersController extends Controller
{
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
        $user = User::findOrFail($id);
        $posts = $user->posts;

        foreach ($posts as $post) {
            $post->replies()->delete();
            $post->delete();
        }

        $user->replies()->delete();
        $user->delete();

        return back();
    }
}
