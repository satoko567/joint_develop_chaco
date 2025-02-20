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

if (!function_exists('totalCommentCounts')) {
    function totalCommentCounts($post)
    {
        $countAllReplies = function ($comments) use (&$countAllReplies) {
            return $comments->sum(fn($comment) => 1 + $countAllReplies($comment->replies));
        };

        return ['totalReplies' => $countAllReplies($post->comments()->with('replies')->get())];
    }
}