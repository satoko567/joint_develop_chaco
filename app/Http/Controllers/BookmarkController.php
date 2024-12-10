<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;

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
    public function index()
    {
        $user = Auth::user();
        $bookmarkedPosts = $user->bookmarkedPosts()->with('user');
        return view('users.show', [
            'user' => $user,
            'bookmarkedPosts' => $bookmarkedPosts,
        ]);
    }
}
