<?php

use Illuminate\Database\Seeder;
use App\Post;
use App\Tag;

class PostsTableSeeder extends Seeder
{
    public function run()
    {
        factory(Post::class, 100)->create()->each(function ($post) {
            // ランダムに1〜3個のタグを付ける
            $tagIds = Tag::inRandomOrder()->take(rand(1, 3))->pluck('id');
            $post->tags()->sync($tagIds);
        });
    }
}