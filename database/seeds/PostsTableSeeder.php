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
        $users = DB::table('users')->get();

        foreach ($users as $user) {
            DB::table('posts')->insert([
                [
                    'user_id' => $user->id,
                    'content' => 'シーダーのテスト投稿です',
                ],
                [
                    'user_id' => $user->id,
                    'content' => 'シーダーから複数投稿のテストです',
                ],
            ]);
        }
    }
}
