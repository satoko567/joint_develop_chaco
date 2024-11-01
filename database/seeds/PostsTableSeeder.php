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
        for ($id = 1; $id <= 3; $id++) {
            for ($i = 1; $i <= 3; $i++){
                DB::table('posts')->insert([
                    'user_id' => $id,
                    'content, 140' => 'テスト投稿'. $i,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'deleted_at' => now(),
                ]);   
            }
        }
    }
}