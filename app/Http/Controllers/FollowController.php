<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function store($id)
    {
        \Auth::user()->following($id);
        return back();
    }

    public function destroy($id)
    {
        \Auth::user()->unfollow($id);
        return back();
    }
}
