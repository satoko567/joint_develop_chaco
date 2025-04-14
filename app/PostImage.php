<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostImage extends Model
{

    protected $fillable = ['post_id','image_path'];

    use SoftDeletes;

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
