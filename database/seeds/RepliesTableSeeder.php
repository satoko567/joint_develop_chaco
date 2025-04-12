<?php

use Illuminate\Database\Seeder;
use App\Reply;
use App\Post;
use App\User;

class RepliesTableSeeder extends Seeder
{
    public function run()
    {
        $posts = Post::all();
        $users = User::all();

        // 各投稿に3件ずつランダムなユーザーからリプライ
        foreach ($posts as $post) {
            for ($i = 0; $i < 15; $i++) {
                Reply::create([
                    'post_id' => $post->id,
                    'user_id' => $users->random()->id,
                    'content' => 'これはダミーのリプライです。'
                ]);
            }
        }
    }
}
