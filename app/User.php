<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

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

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id')
            ->withTimestamps();
    }

    public function followings()
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id')
            ->withTimestamps();
    }
    
    public function follow($id)
    {
        if ($this->id === $id || $this->isFollowing($id)) 
        {
            return false;
        }    
        $this->followings()->attach($id);
        return true;
    }   

    public function unfollow($id)
    {
        if ($this->isFollowing($id))  
        {
            $this->followings()->detach($id);
            return true;
        }
        return false;  
    }

    public function isFollowing($id)
    {
        return $this->followings()->where('users.id', $id)->exists();
    }

    public function userCounts()
    {
        $countFollowings = $this->followings()->count();
        $countFollowers = $this->followers()->count();
        return [
            'countPosts' => $this->posts()->count(),
            'countFollowings' => $countFollowings,
            'countFollowers' => $countFollowers,
        ];
    }
}