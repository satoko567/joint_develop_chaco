<?php

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return \App\User::inRandomOrder()->first()->id;
        },
        'content' => $faker->realText(100),
    ];
});
