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

    public function following()
    {
        return $this->belongsToMany(User::class, 'follows','user_id', 'follow_id')->withTimestamps();
    }

    public function followed()
    {
        
        return $this->belongsToMany(User::class, 'follows','follow_id','user_id')->withTimestamps();
    }

    // フォローをする
    public function follow($follow_id)
    {
        $exist = $this->isFollow($follow_id);
        if ($exist) {
            return false; // 既にフォローしていればフォローできないようにする
        } else {
            $this->following()->attach($follow_id); // フォローしてなければフォローができる
            return true;
        }
    }

    // フォローを外す
    public function unfollow($follow_id)
    {
        $exist = $this->isFollow($follow_id);
        if ($exist) {
            $this->following()->detach($follow_id); // 既にフォローしていればフォローを外すことができる
            return true;
        } else {
            return false; // フォローをしていなければフォローを外すことはできない
        }
    }

    // 既にフォローしているか判定
    public function isFollow($follow_id)
    {
        return $this->following()->where('follow_id', $follow_id)->exists();
    }
}