<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function totalCounts($user)
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
