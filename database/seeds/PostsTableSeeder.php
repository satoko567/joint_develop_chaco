<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    //  userIDカラムが必要
    public function run()
    {
        DB::table('posts')->insert([
            'user_id' => 7,
            'content' => 'sake'
        ]);
        DB::table('posts')->insert([
            'user_id' => 8,
            'content' => 'soju'
        ]);
        DB::table('posts')->insert([
            'user_id' => 9,
            'content' => 'wine'
        ]);
        DB::table('posts')->insert([
            'user_id' => 10,
            'content' => 'beer'
        ]);
    }
}
