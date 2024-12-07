<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FollowController extends Controller
{
    // フォローをする
    public function store($id)
    {
        \Auth::user()->follow($id);
        return back();
    }

    // フォローを外す
    public function destroy($id)
    {
        \Auth::user()->unfollow($id);
        return back();
    }
}
