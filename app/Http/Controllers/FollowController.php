<?php

namespace App\Http\Controllers;

use App\User;  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); 
    }

    public function follow($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'ログインしてください');
        }
    
        $user = User::findOrFail($id);
        \Auth::user()->followings()->attach($user->id);
        return back();
    }

    public function unfollow($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'ログインしてください');
        }
    
        $user = User::findOrFail($id);
        \Auth::user()->followings()->detach($user->id);
    
        return back();
    }

    public function showFollowings($id)
    {
        $user = User::findOrFail($id);
        $followings = $user->followings;

        return view('users.followings', compact('user', 'followings'));
    }

    public function showFollowers($id)
    {
        $user = User::findOrFail($id);
        $followers = $user->followers;

        return view('users.followers', compact('user', 'followers'));
    }
}