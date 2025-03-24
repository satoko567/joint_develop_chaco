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
            'content' => 'test1'
        ]);
        DB::table('posts')->insert([
            'user_id' => 2,
            'content' => 'test2'
        ]);
        DB::table('posts')->insert([
            'user_id' => 3,
            'content' => 'test3'
        ]);
        DB::table('posts')->insert([
            'user_id' => 4,
            'content' => 'test4'
        ]);
        DB::table('posts')->insert([
            'user_id' => 5,
            'content' => 'test5'
        ]);
        DB::table('posts')->insert([
            'user_id' => 6,
            'content' => 'test6'
        ]);
        DB::table('posts')->insert([
            'user_id' => 7,
            'content' => 'test7'
        ]);
        DB::table('posts')->insert([
            'user_id' => 8,
            'content' => 'test8'
        ]);
        DB::table('posts')->insert([
            'user_id' => 9,
            'content' => 'test9'
        ]);
        DB::table('posts')->insert([
            'user_id' => 10,
            'content' => 'test10'
        ]);
        DB::table('posts')->insert([
            'user_id' => 11,
            'content' => 'test11'
        ]);
    }
}
