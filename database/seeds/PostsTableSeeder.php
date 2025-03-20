<?php

use Illuminate\Database\Seeder;
use App\Post; //追加

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Post::class, 10)->create(); // 10件分のデータを作成
    }
}
