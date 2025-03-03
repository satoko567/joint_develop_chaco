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
        DB::table('posts')->insert([
            [
                'user_id' => 1,
                'title' => 'ジャンプ漫画',
                'content' => 'ドラゴンボール',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'title' => 'ジャンプ漫画',
                'content' => 'ワンピース',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
