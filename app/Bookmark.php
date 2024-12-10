<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    protected $fillable = ['user_id', 'post_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function index()
    {
        $user = \Auth::user();
        $bookmarkedPosts = $user->bookmarkedPosts()->with('user')->paginate(10);

        return view('bookmarks.index', compact('bookmarkedPosts'));
    }
}
