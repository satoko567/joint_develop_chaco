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
        $time = Carbon::now();
        DB::table('posts')->insert([
            'user_id' => 1,
            'content' => 'これは1番目の投稿の内容です。',
            'created_at' => $time,
            'updated_at' => $time,
        ]);
        $time = $time->addMinutes(10);
        DB::table('posts')->insert([
            'user_id' => 2,
            'content' => 'これは2番目の投稿の内容です。',
            'created_at' => $time,
            'updated_at' => $time,
        ]);
        $time = $time->addMinutes(10);
        DB::table('posts')->insert([
            'user_id' => 3,
            'content' => 'これは3番目の投稿の内容です。',
            'created_at' => $time,
            'updated_at' => $time,
        ]);
        $time = $time->addMinutes(10);
        DB::table('posts')->insert([
            'user_id' => 4,
            'content' => 'これは4番目の投稿の内容です。',
            'created_at' => $time,
            'updated_at' => $time,
        ]);
        $time = $time->addMinutes(10);
        DB::table('posts')->insert([
            'user_id' => 5,
            'content' => 'これは5番目の投稿の内容です。',
            'created_at' => $time,
            'updated_at' => $time,
        ]);
        $time = $time->addMinutes(10);
        DB::table('posts')->insert([
            'user_id' => 1,
            'content' => 'これは6番目の投稿の内容です。',
            'created_at' => $time,
            'updated_at' => $time,
        ]);
        $time = $time->addMinutes(10);
        DB::table('posts')->insert([
            'user_id' => 2,
            'content' => 'これは7番目の投稿の内容です。',
            'created_at' => $time,
            'updated_at' => $time,
        ]);
        $time = $time->addMinutes(10);
        DB::table('posts')->insert([
            'user_id' => 3,
            'content' => 'これは8番目の投稿の内容です。',
            'created_at' => $time,
            'updated_at' => $time,
        ]);
        $time = $time->addMinutes(10);
        DB::table('posts')->insert([
            'user_id' => 4,
            'content' => 'これは9番目の投稿の内容です。',
            'created_at' => $time,
            'updated_at' => $time,
        ]);
        $time = $time->addMinutes(10);
        DB::table('posts')->insert([
            'user_id' => 5,
            'content' => 'これは10番目の投稿の内容です。',
            'created_at' => $time,
            'updated_at' => $time,
        ]);
        $time = $time->addMinutes(10);
        DB::table('posts')->insert([
            'user_id' => 1,
            'content' => 'これは11番目の投稿の内容です。',
            'created_at' => $time,
            'updated_at' => $time,
        ]);
        $time = $time->addMinutes(10);
    }
}