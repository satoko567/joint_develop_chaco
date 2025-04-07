<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    // 退会したユーザの投稿削除
    protected static function boot()
    {
        parent::boot();

        static::deleting(function($user){
            $user->posts()->delete();
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // 投稿とリレーション
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    // フォローリレーション(フォローしているユーザを取得)
    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'following_id');
    }

    // フォロワーリレーション(フォローされているユーザを取得)
    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'follower_id');
    }

    // フォローチェック
    public function isFollowing($userId)
    {
        return $this->following()->where('following_id', $userId)->exists();
    }

    // フォローメソッド
    public function follow($userId)
    {
        //自分をフォローした場合処理中断
        if(Auth::id() === $userId){
            return false;
        }

        //存在しないユーザをフォローした場合処理中断
        if(!User::find($userId)){
            return false;
        }

        if(!$this->isFollowing($userId)){
            $this->following()->attach($userId);
            return true;
        }
    }

    // フォロー解除メソッド
    public function unFollow($userId)
    {
        if($this->isFollowing($userId)){
            $this->following()->detach($userId);
            return true;
        }
    }

    // いいね
    public function likes()
    {
        return $this->belongsToMany(Post::class, 'likes', 'user_id', 'post_id')->withTimestamps();
    }
}
