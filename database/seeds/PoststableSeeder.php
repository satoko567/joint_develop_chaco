<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = DB::table('users')->get();

        //投稿内容は「今日の気分」と仮定しました
        foreach ($users as $user) {
            DB::table('posts')->insert([
                [
                    'user_id' => $user->id,
                    'content' => '今日はコーヒーが飲みたい',
                ],
                [
                    'user_id' => $user->id,
                    'content' => '今日の天気は晴れで気持ちがいい',
                ],
                [
                    'user_id' => $user->id,
                    'content' => '今日のご飯はお肉にしよう！',
                ],
            ]);
        }
    }
}
