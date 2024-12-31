<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\SoftDeletes;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 11; $i++){//ここから追加
            DB::table('posts')->insert([
                'user_id' => $i,
                'content' => 'これは最初の投稿の内容です。',
                'title'=>'string',
                'created_at' => now(),
                'updated_at' => now(),
                'softDeletes'=> now(),
            ]);
        }
    }
}