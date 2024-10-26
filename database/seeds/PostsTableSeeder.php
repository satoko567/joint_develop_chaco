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
        
        DB::table('posts')->insert([
            'content' => 'テスト1',
            'user_id' => '1',
        ]);

        DB::table('posts')->insert([
            'content' => 'テスト2',
            'user_id' => '2',
        ]);

        DB::table('posts')->insert([
            'content' => 'テスト3',
            'user_id' => '3',
        ]);

        DB::table('posts')->insert([
            'content' => 'テスト4',
            'user_id' => '4',
        ]);

        DB::table('posts')->insert([
            'content' => 'テスト5',
            'user_id' => '1',
        ]);

        DB::table('posts')->insert([
            'content' => 'テスト6',
            'user_id' => '2',
        ]);

        DB::table('posts')->insert([
            'content' => 'テスト7',
            'user_id' => '3',
        ]);

        DB::table('posts')->insert([
            'content' => 'テスト8',
            'user_id' => '4',
        ]);

        DB::table('posts')->insert([
            'content' => 'テスト9',
            'user_id' => '1',
        ]);

        DB::table('posts')->insert([
            'content' => 'テスト10',
            'user_id' => '2',
        ]);

        DB::table('posts')->insert([
            'content' => 'テスト11',
            'user_id' => '3',
        ]);

        DB::table('posts')->insert([
            'content' => 'テスト12',
            'user_id' => '4',
        ]);

    }
}
