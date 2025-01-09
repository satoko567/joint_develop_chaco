<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 12件の投稿テストデータ作成
     * 
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 12; $i++) {
            DB::table('posts')->insert([
                'user_id' => (($i - 1) % 4) + 1, // 1から4までのuser_idを繰り返し
                'content' =>  $i . '番目のテスト投稿です！',
                'created_at' => now(),
            ]);
        }
    }
}
