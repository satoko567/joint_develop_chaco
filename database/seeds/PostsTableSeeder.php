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
            'user_id' => 1,
            'post' => 'test1'
        ]);
        DB::table('posts')->insert([
            'user_id' => 2,
            'post' => 'test2'
        ]);
        DB::table('posts')->insert([
            'user_id' => 3,
            'post' => 'test3'
        ]);
    }
}
