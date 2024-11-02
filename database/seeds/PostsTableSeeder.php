<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\UsersTableSeeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($id = 1; $id <= 3; $id++) {
            for ($i = 1; $i <= 3; $i++){
                DB::table('posts')->insert([
                    'user_id' => $id,
                    'content, 140' => 'テスト投稿',
                    'created_at' => now(),
                    'updated_at' => now(),
                    'deleted_at' => now(),
                ]);   
            }
        }
    }
}