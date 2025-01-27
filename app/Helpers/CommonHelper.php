<?php

namespace App\Helpers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

class CommonHelper
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function totalCounts($user)
    {
        $totalFollowers = $user->followers->count();
        $totalFollowing = $user->following->count();
        $totalPosts = $user->posts()->count();
    
        return [
            'totalFollowers' => $totalFollowers,
            'totalFollowing' => $totalFollowing,
            'totalPosts' => $totalPosts,
        ];
    }   

}