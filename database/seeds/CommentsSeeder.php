<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $timestamp = Carbon::now();

        // 各ユーザーが各 post に一回返信する
        for ($user_id = 1; $user_id <= 2; $user_id++) {
            for ($post_id = 7; $post_id <= 11; $post_id++) {
                DB::table('comments')->insert([
                    'post_id'   => $post_id,
                    'user_id'   => $user_id,
                    'content'   => "This is a comment by user {$user_id} on post {$post_id}.",
                    'parent_id' => null,
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp
                ]);
                $timestamp = $timestamp->copy()->addMinutes(2);
            }
        }

        // 各ユーザーが特定の親コメントに対して返信する
        $parent_ranges = [
            1 => [1, 6],
            2 => [6, 10],
            3 => [11, 21],
            4 => [18, 20],
            5 => [21, 25],
        ];

        foreach ($parent_ranges as $user_id => [$start, $end]) {
            for ($parent_id = $start; $parent_id <= $end; $parent_id++) {
                // 親コメントの post_id を取得
                $parent_comment = DB::table('comments')->where('id', $parent_id)->first();
                if (!$parent_comment) continue;

                DB::table('comments')->insert([
                    'post_id'   => $parent_comment->post_id, // 親コメントの post_id を継承
                    'user_id'   => $user_id,
                    'content'   => "Reply by user {$user_id} to comment {$parent_id}.",
                    'parent_id' => $parent_id,
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp
                ]);
                $timestamp = $timestamp->copy()->addMinutes(2);
            }
        }
    }
}
