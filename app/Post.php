<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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

    // 投稿を削除したら関連リプライも論理削除される
    public function deleteWithReplies()
    {
        $this->replies()->delete();
        $this->delete();
    }
}