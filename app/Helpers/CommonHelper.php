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

if (!function_exists('CommentCounts')) {
    function CommentCounts($post)
    {
        return ['totalReplies' => count($post->allComments()->get())];
    }
}

if (!function_exists('getFireIcons')) {
    function getFireIcons($totalReplies)
    {
        $thresholds = config('constants.FIRE');
        foreach ($thresholds as $threshold => $icons) {
            if ($totalReplies >= $threshold) {
                return $icons;
            }
        }
        return '';
    }
}
