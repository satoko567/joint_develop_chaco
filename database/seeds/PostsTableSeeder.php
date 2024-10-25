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
        for($i = 1; $i <= 5; $i ++){ // テストを5件
            DB::table('posts')->insert([
                'content' => 'テスト投稿だよ'. $i,
                'user_id' => $i,
            ]);
        }
    }
}
