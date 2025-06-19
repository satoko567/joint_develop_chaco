<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;

class TagController extends Controller
{
    public function search($id)
    {
        $tag = Tag::findOrFail($id);
        $posts = $tag->posts()->with('user', 'tags')->latest()->paginate(10);

        return view('tags.search', compact('tag', 'posts'));
    }

}
