<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PostImage;
use Illuminate\Support\Facades\Storage;

class PostImagesController extends Controller
{
    // 投稿画像編集
    public function update(Request $request, $id)
    {
        $postImage = PostImage::findOrFail($id);

        if ($request->hasFile('image')) {
            if (Storage::exists('public/' . $postImage->image_path)) {
                Storage::delete('public/' . $postImage->image_path);
            }
        }

        $newImagePath = $request->file('image')->store('post_images', 'public');

        $postImage->image_path = $newImagePath;
        $postImage->save();

        return back();
    }

    // 投稿画像削除
    public function destroy($id)
    {
        $postImage = PostImage::findOrFail($id);

        if (Storage::exists('public/' . $postImage->image_path)) {
            Storage::delete('public/' . $postImage->image_path); // 対象の画像をストレージから削除
        }

        $postImage->delete();

        return back();
    }
}
