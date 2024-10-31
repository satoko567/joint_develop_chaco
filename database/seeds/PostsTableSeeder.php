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
        for ($i = 1; $i <= 10; $i++) {
                DB::table('posts')->insert([
                    'user_id' => $i,
                    'content' => 'テスト投稿'. $i,
                    'name' => 'test1',
                    'email' => 'test1@test.com',
                    'password' => bcrypt('test1')
                    'created_at' => now(),
                    'updated_at' => now(),
                    'deleted_at' => now(),
                ]);
                DB::table('posts')->insert([
                    'user_id' => $i,
                    'content' => 'テスト投稿'. $i,
                    'name' => 'test2',
                    'email' => 'test2@test.com',
                    'password' => bcrypt('test2')
                    'created_at' => now(),
                    'updated_at' => now(),
                    'deleted_at' => now(),
                ]);
                DB::table('posts')->insert([
                    'user_id' => $i,
                    'content' => 'テスト投稿'. $i,
                    'name' => 'test3',
                    'email' => 'test3@sample.com',
                    'password' => bcrypt('test3')
                    'created_at' => now(),
                    'updated_at' => now(),
                    'deleted_at' => now(),
                ]);
                DB::table('posts')->insert([
                    'user_id' => $i,
                    'content' => 'テスト投稿'. $i,
                    'name' => 'test4',
                    'email' => 'test4@test.com',
                    'password' => bcrypt('test4')
                    'created_at' => now(),
                    'updated_at' => now(),
                    'deleted_at' => now(),
                ]);   
            }
}
}
