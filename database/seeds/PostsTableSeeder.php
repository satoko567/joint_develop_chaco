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
        $contents = ['test1', 'test2', 'てすと3'];

        foreach ($users as $user) {
            foreach ($contents as $content) {
                DB::table('posts')->insert([
                    'user_id' => $user->id,
                    'content' => $content,
                ]);
            }
        }

        $this->call(UsersTableSeeder::class);
    }
}
