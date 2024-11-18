<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store($postId)
    {
        \Auth::user()->like($postId);
        return back();
    }
    public function destroy($postId)
    {
        \Auth::user()->unlike($postId);
        return back();
    }
}
