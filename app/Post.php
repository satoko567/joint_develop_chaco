<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    // 投稿と関連するリプライ・画像をすべて削除する
    public function deleteWithAssets()
    {
        if ($this->image) {
            Storage::disk('public')->delete($this->image);
        }
        $this->replies()->delete();
        $this->delete();
    }
}