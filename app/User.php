<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

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
        'name', 'email', 'password','date_of_birth',
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
        'date_of_birth' => 'date',
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

    public function likedPosts()
    {
        return $this->belongsToMany(Post::class, 'likes')->withTimestamps();
    }

    public function like($postId)
    {
        $exist = $this->hasLiked($postId);
        if ($exist) {
            return false;
        } else {
            $this->likedPosts()->attach($postId);
            return true;
        }
    }

    public function unlike($postId)
    {
        $exist = $this->hasLiked($postId);
        if ($exist) {
            $this->likedPosts()->detach($postId);
            return true;
        } else {
            return false;
        }
    }

    public function hasLiked($postId)
    {
        return $this->likedPosts()->where('post_id', $postId)->exists();
    }
    
    public function comments()
    {
        return $this->hasManyThrough(Comment::class, Post::class);
    }

    public function bookmarkedPosts()
    {
        return $this->belongsToMany(Post::class, 'bookmarks')->withTimestamps();
    }

    public function bookmark($postId)
    {
        $exist = $this->hasBookmarked($postId);
        if ($exist) {
            return false;
        } else {
            $this->bookmarkedPosts()->attach($postId);
            return true;
        }
    }

    public function unbookmark($postId)
    {
        $exist = $this->hasBookmarked($postId);
        if ($exist) {
            $this->bookmarkedPosts()->detach($postId);
            return true;
        } else {
            return false;
        }
    }

    public function hasBookmarked($postId)
    {
        return $this->bookmarkedPosts()->where('post_id', $postId)->exists();
    }

    public function scopeWithSimilarAges(Builder $query, $dateOfBirth, $ageRange = 5, $excludeIds = [])
    {
        $currentAge = Carbon::parse($dateOfBirth)->age;
        $minAge = $currentAge - $ageRange;
        $maxAge = $currentAge + $ageRange;
        $maxDate = Carbon::now()->subYears($minAge)->format('Y-m-d');
        $minDate = Carbon::now()->subYears($maxAge)->format('Y-m-d');
        return $query->whereBetween('date_of_birth', [$minDate, $maxDate])
                    ->when(!empty($excludeIds), function ($query) use ($excludeIds) {
                        return $query->whereNotIn('id', $excludeIds);
                    });
    }

    public function isAllFollowing ()
    {
        if (!$this->date_of_birth) {
            return false; // 生年月日がない場合
        }

        $followingsCount = $this->following()->count();
        $similarUsersWithFollowingsCount = self::where('id', '!=', $this->id)
                ->WithSimilarAges($this->date_of_birth, 5)
                ->get()
                ->count();
                
        return $followingsCount === $similarUsersWithFollowingsCount && $followingsCount > 0;
    }

    public function getUsersWithSimilarAges(int $ageRange = 5, array $excludeIds = [])
    {
        if (!$this->date_of_birth) {
            return collect();
        }

        return self::where('id', '!=', $this->id)
            ->WithSimilarAges($this->date_of_birth, $ageRange, $excludeIds)
            ->take(5)
            ->get();
    }
}