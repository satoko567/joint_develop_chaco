<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'id' => $faker->unique()->randomNumber(2),
        'content' => $faker->realText(140),
        'user_id' => $faker->numberBetween(1, 10),
        'post_id' => $faker->numberBetween(1, 10),
        'delete_flg' => $faker->numberBetween(0, 1),
        'created_at' => now(),
        'updated_at' => now(),
        'deleted_at' => null,
    ];
});
