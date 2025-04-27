<?php

use Illuminate\Database\Seeder;
use App\Tag;

class TagsTableSeeder extends Seeder
{
    public function run()
    {
        $tags = [
            "C", "C+", "C++", "C#", "Django", "Eclips", "Flutter", "Go", "java",
            "laravel", "php", "rust", "ruby", "rails", "react", "swift", "typescrypt", "vue"
        ];

        foreach ($tags as $tagName) {
            Tag::firstOrCreate(['name' => $tagName]);
        }
    }
}

