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
            'name' => 'sake',
            'email' => 'test1@test.com',
            'password' => bcrypt('test1')
        ]);
        DB::table('posts')->insert([
            'name' => 'soju',
            'email' => 'test2@test.com',
            'password' => bcrypt('test2')
        ]);
        DB::table('posts')->insert([
            'name' => 'beer',
            'email' => 'test3@sample.com',
            'password' => bcrypt('test3')
        ]);
        DB::table('posts')->insert([
            'name' => 'wine',
            'email' => 'test4@test.com',
            'password' => bcrypt('test4')
        ]);
        DB::table('posts')->insert([
            'name' => 'cocktail',
            'email' => 'test5@test.com',
            'password' => bcrypt('test5')
        ]);
        DB::table('posts')->insert([
            'name' => 'sour',
            'email' => 'test6@test.com',
            'password' => bcrypt('test6')
        ]);
    }
}
