<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\User;

class FollowerSeeder extends Seeder
{
    public function run()
    {
        // 全ユーザーを取得
        $users = User::all();
        $time = Carbon::now();

        // すべてのユーザー間でフォロー関係を作成
        foreach ($users as $user) {
            foreach ($users as $otherUser) {
                // 自分自身をフォローすることはスキップ
                if ($user->id !== $otherUser->id) {
                    DB::table('followers')->updateOrInsert(
                        [
                            'user_id' => $user->id,
                            'followed_user_id' => $otherUser->id,
                        ],
                        [
                            'created_at' => $time,
                            'updated_at' => $time,
                        ]
                    );
                    $time = $time->addMinutes(3);
                }
            }
        }
    }
}
