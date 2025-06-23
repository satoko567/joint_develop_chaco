<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name'];

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_tag', 'tag_id', 'post_id')->withTimestamps();
    }

    // タグ名をもとにタグIDを取得・作成
    public static function getTagIds(array $names)
    {
        return collect($names)->map(function ($name) {
            return self::firstOrCreate(['name' => trim($name)])->id;
        })->all();
    }

    // タグ名からIDを取得し、投稿とタグの関係を更新
    public static function syncToPost(Post $post, array $tagNames)
    {
        $tagIds = self::getTagIds($tagNames);
        $post->tags()->sync($tagIds);
    }

    // ユーザー入力されたタグ文字列を整形し、タグ名の配列(重複・空白除去済み)に変換
    public static function parseTagNames(?string $raw): array
    {
        if (!$raw) return [];

        $normalized = str_replace(['，', '、', '　'], [',', ',', ' '], $raw);

        return collect(explode(',', $normalized))
            ->map(fn($tag) => trim($tag))
            ->filter(fn($tag) => $tag !== '')
            ->unique()
            ->values()
            ->toArray();
    }
}