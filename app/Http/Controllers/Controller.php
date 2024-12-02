<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function followCounts($user)
    {
         // フォロー中の人数を数える
        $countFollowing = $user->following()->count();
         // フォロワーの人数を数える
        $countFollowed = $user->followed()->count();

        return [
            'countFollowing' => $countFollowing,
            'countFollowed' => $countFollowed,
        ];
    }
}
