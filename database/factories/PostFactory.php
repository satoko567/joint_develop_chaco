<?php

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    $tags = ['C','C+','C++','C#','Django','Eclips','Flutter','Go','java','laravel','php','rust','ruby','rails','react','swift','typescrypt','vue'];

    // ランダムに2〜4個のワードを選ぶ
    $selected = collect($tags)->random(rand(2, 4))->all();

    // 日本語のテンプレ文と組み合わせる
    $sentences = [
        '最近は%sについて学習しています。',
        '特に%sに興味があります。',
        '今後は%sを深く学びたいと考えています。',
        '%sの習得を目指しています。',
        '%sの開発に取り組んでいます。'
    ];

    $sentence = $faker->randomElement($sentences); // ランダムにテンプレ選択
    $joinedTags = implode('・', $selected);         // 「php・Vue・Go」の形式で連結

    return [
        'user_id' => function () {
            return \App\User::inRandomOrder()->first()->id;
        },
        'content' => sprintf($sentence, $joinedTags),
    ];
});