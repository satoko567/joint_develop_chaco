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

    // 評価の平均を丸めて返す
    public static function getRoundedAverage($collection, $key)
    {
        $average = $collection->avg($key);
        return $average ? round($average, 1) : null;
    }

    // 投稿に対するリプライ評価の平均を計算
    public static function averageRatingsForPost(Post $post)
    {
        $replies = $post->replies()->whereNull('deleted_at');
        $service = self::getRoundedAverage($replies, 'rating_service');
        $cost    = self::getRoundedAverage($replies, 'rating_cost');
        $quality = self::getRoundedAverage($replies, 'rating_quality');
        $values = collect([$service, $cost, $quality])->filter();
        $overall = $values->isNotEmpty() ? round($values->avg(), 1) : null;
        return [
            'service' => $service,
            'cost'    => $cost,
            'quality' => $quality,
            'overall' => $overall,
        ];
    }
}