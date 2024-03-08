<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes; // 追記

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes; // 追記

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function follows()
    {
        return $this->belongsToMany(User::class, 'follow_users', 'following_id', 'followed_id')->withTimestamps();
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follow_users', 'followed_id', 'following_id')->withTimestamps();
    }

    public function follow($followedId)
{
    if ($followedId != Auth::id() && !$this->isFollow($followedId)) {
        $this->follows()->attach($followedId);
        return true;
    }
    
    return false;
}

public function unfollow($followedId)
{
    if ($followedId != Auth::id() && $this->isFollow($followedId)) {
        $this->follows()->detach($followedId);
        return true;
    }
    
    return false;
}

    public function isFollow($followedId)
    {
        return $this->follows()->where('followed_id', $followedId)->exists();
    }

    public static function boot()
    {
        parent::boot();
    
        static::deleted(function ($user) {
            $user->posts()->delete();
        });
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
