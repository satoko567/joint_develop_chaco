<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    
    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    public function post() 
    {
        return $this->belongsTo(Post::class);
    }

    protected $fillable = [
        'post_id',
        'user_id',
        'content',
    ];

}
