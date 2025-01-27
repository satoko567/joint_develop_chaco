<?php

use App\Helpers\CommonHelper;

if (!function_exists('totalCount')) {
    function totalCount($user)
    {
        return CommonHelper::totalCounts($user);
    }
}
