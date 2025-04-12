<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes; //論理削除を追加

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes; //論理削除

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

    // ユーザがフォローしている投稿を取得するメソッド 
    public function follows()
    {
        return $this->belongsToMany(Post::class, 'follows', 'user_id', 'post_id')->withTimestamps();
    }

    // ユーザがフォローしているか判定するメソッド
    public function isFollow($id)
    {
        return $this->follows()->where('post_id', $id)->exists();
    }

    // フォロー状態を作るメソッド
    public function follow($id)
    {
        // すでにフォローしている場合は何もしない
        $exists = $this->isFollow($id);
        if ($exists) {
            return;
        } else {
        // フォローしていない場合は、フォローを追加
        $this->follows()->attach($id);
        }
    }

    // フォローを解除するメソッド
    public function unfollow($id)
    {
        // フォローしていない場合は何もしない
        $exists = $this->isFollow($id);
        if ($exists) {
            $this->follows()->detach($id);
        } else {
        // フォローしている場合は、フォローを解除
            return;
        }
    }
}
