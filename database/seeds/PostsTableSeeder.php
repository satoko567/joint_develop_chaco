<?php

use Illuminate\Database\Seeder;


class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * @return void
     */
    public function run()
    {
        // 12件の投稿テストデータ（user_id 1～4まで繰り返し）
        for ($i = 1; $i <= 12; $i++) {
            DB::table('posts')->insert([
                'user_id' => (($i - 1) % 4) + 1, // 1から4までのuser_idを繰り返し
                'content' =>  $i . '番目のテスト投稿です！',
                'created_at' => now(),
            ]);
        }

        // user_id が 1（test1）のユーザーに10件分のテストデータを追加
        for ($i = 1; $i <= 10; $i++) {
            DB::table('posts')->insert([
                'user_id' => 1,
                'content' => 'test1のテスト投稿',
                'created_at' => now(),
            ]);
        }
    }
}
