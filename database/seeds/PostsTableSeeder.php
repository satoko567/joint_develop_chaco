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
            'user_id' => '1',
            'content' => 'Hello',
            'created_at' => '2025-01-08 10:05:55'
        ]);
        DB::table('posts')->insert([
            'user_id' => '2',
            'content' => 'Hello!!',
            'created_at' => '2025-01-08 10:08:55'
        ]);
        DB::table('posts')->insert([
            'user_id' => '3',
            'content' => 'Hello!',
            'created_at' => '2025-01-08 10:10:55'
        ]);
        DB::table('posts')->insert([
            'user_id' => '4',
            'content' => 'Hello!!!',
            'created_at' => '2025-01-08 10:15:55'
        ]);
        DB::table('posts')->insert([
            'user_id' => '1',
            'content' => 'Hello',
            'created_at' => '2025-01-08 10:20:55'
        ]);
        DB::table('posts')->insert([
            'user_id' => '1',
            'content' => 'Hello',
            'created_at' => '2025-01-08 10:25:55'
        ]);
        DB::table('posts')->insert([
            'user_id' => '1',
            'content' => 'Hello',
            'created_at' => '2025-01-08 10:30:55'
        ]);
        DB::table('posts')->insert([
            'user_id' => '4',
            'content' => 'Hello!!!',
            'created_at' => '2025-01-08 10:35:55'
        ]);
        DB::table('posts')->insert([
            'user_id' => '1',
            'content' => 'Hello',
            'created_at' => '2025-01-08 10:40:55'
        ]);

        
    }
}
