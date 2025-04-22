<?php

namespace App\Http\Controllers;

use App\Tag;

class TagController extends Controller
{
    public function show($id)
    {
        $tag = Tag::findOrFail($id);
        $posts = $tag->posts()->latest()->paginate(10);

        return view('tags.show', [
            'tag' => $tag,
            'posts' => $posts,
        ]);
    }
}
