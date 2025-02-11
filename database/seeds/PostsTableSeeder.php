<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('ja_JP');

        // UsersTableSeeder.phpの件数と同期をとってください
        $userCounts = 30;

        // ユーザーごとのデフォルトの投稿件数
        $defaultPostCounts = 21;

        // 投稿の最大文字数
        $contentMaxLength = 140;

        //「 '[' . $userId . '-' . $postId . ']' . 」がいるかどうか
        $isNeedPrefixContent = true;

        //テスト代入件数　30件
        for($userIndex = 0; $userIndex < $userCounts; ++$userIndex){

            $userId = ($userIndex + 1);

            // ********************************************************
            // テストケースに合わせてユーザー毎の投稿件数を変更できます
            // パラメータ指定がないものは、$defaultPostCounts件になります。
            // 終わったら、
            // git checkout HEAD -- database/seeds/PostsTableSeeder.php
            // で変更を戻せます。
            // ********************************************************
            // keyがuserId, valueが投稿件数
            // 書いてなかったら、$defaultPostCounts
            $paramMap = [ 
                5 => 3,
                7 => 10,
                8 => 0,
                9 => 0,
                10 => 15,
                11 => 18,
            ];
            // ********************************************************

            $currentUserPostCounts = $defaultPostCounts;
            if (array_key_exists($userId, $paramMap)) {
                $currentUserPostCounts = $paramMap[$userId];
            }

            for($postIndex = 0; $postIndex < $currentUserPostCounts; ++$postIndex){

                $postId = ($postIndex + 1);

                // 1から2の範囲でスムーズさを調整、
                // 2に近いほどスムーズ。それを乱数調整
                $smooth = rand(1, 2);

                $content = $faker->realText($contentMaxLength, $smooth);
                if($isNeedPrefixContent) {
                    $content = '[' . $userId . '-' . $postId . ']' . $content;
                    $content = mb_substr($content, 0, $contentMaxLength);
                }

                DB::table('posts')->insert([
                    'user_id'=> $userId,
                    'content'=> $content,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);    
            }
        }
    } 
}
