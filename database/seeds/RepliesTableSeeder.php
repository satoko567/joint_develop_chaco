<?php

use Illuminate\Database\Seeder;

class RepliesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // user_idが1、post_idが1の投稿に対して12件のテストデータ作成
        for ($i = 1; $i <= 12; $i++) {
            DB::table('replies')->insert([
                'user_id' => $i,
                'post_id' => 1,
                'content' =>  $i . '番目コメントです！',
                'created_at' => now()->addSeconds($i * 3),
            ]);
        }
    }
}
