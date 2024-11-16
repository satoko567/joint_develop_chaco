<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

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

    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'followed_id');
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'followed_id', 'follower_id');
    }

    public function isFollowing($id)
    {
        return $this->following()->where('followed_id', $id)->exists();
    }

    public function follow($id)
    {
        $exist = $this->isFollowing($id);
        if ($exist) {
            return false;
        } else {
            $this->following()->attach($id);
            return true;
        }
    }

    public function unfollow($id)
    {
        $exist = $this->isFollowing($id);
        if ($exist) {
            $this->following()->detach($id);
            return true;
        } else {
            return false;
        }
    }

    public function comments()
    {
        return $this->hasManyThrough(Comment::class, Post::class);
    }
}
