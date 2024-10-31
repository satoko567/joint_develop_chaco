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
        for ($i = 11; $i <= 10; $i++) {
                DB::table('posts')->insert([
                    'user_id' => $i,
                    'content' => 'テスト投稿'. $i,
                    'password' => bcrypt('test1')
                    'created_at' => now(),
                    'updated_at' => now(),
                    'deleted_at' => now(),
                ]);   
            }
}
}
