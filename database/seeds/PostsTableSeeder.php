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
       $users = DB::table('users')->get();

       foreach ($users as $user) {
            DB::table('posts')->insert([
                [
                    'user_id' => $user->id,
                    'content' => 'test1',
                ],
                [
                    'user_id' => $user->id,
                    'content' => 'テスト2',
                ],
                [
                    'user_id' => $user->id,
                    'content' => 'てすと3',
                ],
            ]);
       }
    }
}
