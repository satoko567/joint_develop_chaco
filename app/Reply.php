<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    //投稿時に必要な項目（Mass Assignment）を許可
    protected $fillable = ['user_id', 'post_id', 'content'];

    //投稿とのリレーション（1つのリプライは1つの投稿に属する）
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    //ユーザーとのリレーション（1つのリプライは1人のユーザーに属する）
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
