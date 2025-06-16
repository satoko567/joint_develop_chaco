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

    // 投稿に対するリプライ評価の平均を計算
    public function averageRatings()
    {
        $replies = $this->replies()->whereNull('deleted_at');
        $serviceAvg = $replies->avg('rating_service');
        $costAvg    = $replies->avg('rating_cost');
        $qualityAvg = $replies->avg('rating_quality');
        $service = $serviceAvg ? round($serviceAvg, 1) : null;
        $cost = $costAvg ? round($costAvg, 1) : null;
        $quality = $qualityAvg ? round($qualityAvg, 1) : null;
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