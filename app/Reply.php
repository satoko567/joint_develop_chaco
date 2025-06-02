<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use SoftDeletes;

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ユーザが、投稿にリプライをしたことがあるかの確認
    public static function hasReplied(User $user, Post $post)
    {
        return self::where([
            'user_id' => $user->id,
            'post_id' => $post->id,
        ])->exists();
    }

    // リプライ件数
    public static function replyCounts(Post $post)
    {
        $countReplies = self::where('post_id', $post->id)
                            ->whereNull('deleted_at')
                            ->count();
        return [
            'countReplies' => $countReplies,
        ];
    }

    // 最新リプライ
    public static function latestReply(Post $post)
    {
        return self::where('post_id', $post->id)
                    ->latest()
                    ->first();
    }
}