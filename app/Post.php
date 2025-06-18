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

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // 投稿と関連するレビューをすべて削除する
    public function deleteReviews()
    {
        $this->reviews()->delete();
    }
    
    // 投稿と関連する画像を削除する
    public function deleteImage()
    {
        if ($this->image) {
            Storage::disk('public')->delete($this->image);
        }
    }

    // 経度、緯度をfillableに追加　マスアサインメント保護
    protected $fillable = [
        'content', 'image', 'lat', 'lng',
    ];
    // 論理削除されていないレビューの各評価項目の平均値を連想配列で返すアクセサ
    public function getAverageRatingsAttribute()
    {
        $reviews = $this->reviews()->whereNull('deleted_at')->get();
        return Review::averageRatingsFromCollection($reviews);
    }
}