<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    protected $fillable = ['user_id', 'content', 'image_path'];

    use SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
