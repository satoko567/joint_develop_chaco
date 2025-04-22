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

    public function followUsers()
    {
        return $this->belongsToMany(User::class, 'follows', 'post_id', 'user_id')->withTimestamps();
    }

    public function tags()
{
    return $this->belongsToMany(Tag::class);
}
}
