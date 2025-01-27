<?php						

class CommonHelper								
{															
								
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
						
if (!function_exists('totalCount')) {						
    function totalCount($user)						
    {						
        return CommonHelper::totalCounts($user);						
    }						
}		