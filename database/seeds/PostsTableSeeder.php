<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * @return void
     */
    public function run()
    {
        // 各user_id 1 ~ 4 に 12件の投稿テストデータ作成（合計48件の投稿テストデータ）
        for ($i = 1; $i <= 48; $i++) {
            DB::table('posts')->insert([
                'user_id' => (($i - 1) % 4) + 1, // 1から4までのuser_idを繰り返し
                'content' =>  $i . '番目のテスト投稿です！',
                'created_at' => Carbon::create(2025, 2, 15, 12, 0, 0)->addSeconds($i * 60),
            ]);
        }
    }
}
