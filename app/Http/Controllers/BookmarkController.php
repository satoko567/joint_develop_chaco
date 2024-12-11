<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    public function store($postId)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        \Auth::user()->bookmark($postId);
        return back();
    }

    public function destroy($postId)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        \Auth::user()->unbookmark($postId);
        return back();
    }

    // 自分のブックマーク一覧
    public function index($id)
    {
        $user = Auth::user($id);
        $bookmarkedPosts = $user->bookmarkedPosts()->with('user')->paginate(10);
        return view('users.show', [
            'user' => $user,
            'bookmarkedPosts' => $bookmarkedPosts,
        ]);
    }
}
