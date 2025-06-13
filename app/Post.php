<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $fillable = [
        'content',
        'user_id',
        'image_path',
    ];

}
