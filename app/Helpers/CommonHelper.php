<?php						

if (!function_exists('totalCounts')) {
    function totalCount($user)
    {
        return [
            'totalFollowers' => $user->followers->count(),
            'totalFollowing' => $user->following->count(),
            'totalPosts' => $user->posts()->count(),
        ];
    }
}