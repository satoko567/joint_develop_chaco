<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;

class MakeFollowsTestData extends Command
{
    // ************************************************************************************
    // 使い方_2025_02_11時点のシーダーの実装で、
    // php artisan migrate:fresh --seed
    // をした時点のデータ状況で、
    // php artisan maketestdata:make_follows_testdata
    // にて当コマンドを実行し、test1から23付近のユーザのフォロー関係を構築する
    // test4のユーザーのフォロー関係が多めに構築される内容になってます
    // フォロー関係の動作確認やデバッグに有効なデータ状況になります。
    // 上記、処理内容的にシーダーの実装は不適切なため、当コマンド実装で準備してます。
    // ************************************************************************************

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'maketestdata:make_follows_testdata';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->commonFollowUnFollow(true);
    }

    private function commonFollowUnFollow($isFollow)
    {
        // ************************************************************************************
        // 想定のデータ例)
        // 1) 下記「id=1のデータ」 user_id=3がuser_id=5をフォローしている
        // 2) 下記「id=2のデータ」 user_id=5がuser_id=3をフォローしている
        // 3) 下記「id=3のデータ」 user_id=4がuser_id=5をフォローしている
        // 4) 下記「id=4のデータ」 user_id=6がuser_id=5をフォローしている
        // 5) 下記「id=5のデータ」 user_id=3がuser_id=4をフォローしている
        //
        // id  from_user_id  to_user_id  created_at        updated_at
        // 1   3             5           フォローした日時   フォローした日時
        // 2   5             3           フォローした日時   フォローした日時
        // 3   4             5           フォローした日時   フォローした日時
        // 4   6             5           フォローした日時   フォローした日時
        // 5   3             4           フォローした日時   フォローした日時
        //
        // フォロー解除は、followsの物理削除とします。
        // ************************************************************************************

        $paramMap = [
            // 1) id=3がid=5をフォローしている
            ['user_id' => 3, 'other_user_id' => 5],

            // 2) id=5がid=3をフォローしている
            ['user_id' => 5, 'other_user_id' => 3],

            // 3) id=4がid=5をフォローしている
            ['user_id' => 4, 'other_user_id' => 5],

            // 4) id=6がid=5をフォローしている
            ['user_id' => 6, 'other_user_id' => 5],

            // 5) id=3がid=4をフォローしている
            ['user_id' => 3, 'other_user_id' => 4],

            // user_id=4についての増幅コード、（その１）
            ['user_id' => 4, 'other_user_id' => 1],
            ['user_id' => 4, 'other_user_id' => 2],
            ['user_id' => 4, 'other_user_id' => 3],
            //** ['user_id' => 4, 'other_user_id' => 4],
            ['user_id' => 4, 'other_user_id' => 5],
            ['user_id' => 4, 'other_user_id' => 6],
            ['user_id' => 4, 'other_user_id' => 7],
            ['user_id' => 4, 'other_user_id' => 8],
            ['user_id' => 4, 'other_user_id' => 9],
            ['user_id' => 4, 'other_user_id' => 10],

            ['user_id' => 4, 'other_user_id' => 11],
            ['user_id' => 4, 'other_user_id' => 12],
            ['user_id' => 4, 'other_user_id' => 13],
            ['user_id' => 4, 'other_user_id' => 14],
            ['user_id' => 4, 'other_user_id' => 15],
            ['user_id' => 4, 'other_user_id' => 16],
            ['user_id' => 4, 'other_user_id' => 17],
            ['user_id' => 4, 'other_user_id' => 18],
            ['user_id' => 4, 'other_user_id' => 19],
            ['user_id' => 4, 'other_user_id' => 20],

            ['user_id' => 4, 'other_user_id' => 21],
            ['user_id' => 4, 'other_user_id' => 22],
            ['user_id' => 4, 'other_user_id' => 23],
            //** ['user_id' => 4, 'other_user_id' => 24],
            //** ['user_id' => 4, 'other_user_id' => 25],
            //** ['user_id' => 4, 'other_user_id' => 26],
            //** ['user_id' => 4, 'other_user_id' => 27],
            //** ['user_id' => 4, 'other_user_id' => 28],
            //** ['user_id' => 4, 'other_user_id' => 29],
            //** ['user_id' => 4, 'other_user_id' => 30],

            // user_id=4についての増幅コード、（その２）
            ['user_id' => 1, 'other_user_id' => 4],
            ['user_id' => 2, 'other_user_id' => 4],
            ['user_id' => 3, 'other_user_id' => 4],
            //*** ['user_id' => 4, 'other_user_id' => 4],
            ['user_id' => 5, 'other_user_id' => 4],
            ['user_id' => 6, 'other_user_id' => 4],
            ['user_id' => 7, 'other_user_id' => 4],
            ['user_id' => 8, 'other_user_id' => 4],
            ['user_id' => 9, 'other_user_id' => 4],
            ['user_id' => 10, 'other_user_id' => 4],

            ['user_id' => 11, 'other_user_id' => 4],
            ['user_id' => 12, 'other_user_id' => 4],
            ['user_id' => 13, 'other_user_id' => 4],
            ['user_id' => 14, 'other_user_id' => 4],
            ['user_id' => 15, 'other_user_id' => 4],
            ['user_id' => 16, 'other_user_id' => 4],
            ['user_id' => 17, 'other_user_id' => 4],
            ['user_id' => 18, 'other_user_id' => 4],
            ['user_id' => 19, 'other_user_id' => 4],
            ['user_id' => 20, 'other_user_id' => 4],

            ['user_id' => 21, 'other_user_id' => 4],
            ['user_id' => 22, 'other_user_id' => 4],
            ['user_id' => 23, 'other_user_id' => 4],
        ];
        
        foreach ($paramMap as $pair) {
            $user_id = $pair['user_id'];
            $other_user_id = $pair['other_user_id'];

            $user = User::findOrFail($user_id);
            if($isFollow) {
                $user->follow($other_user_id);
                $this->info("{$user_id}が{$other_user_id}をフォローしました。");
            } else {
                $user->unfollow($other_user_id);
                $this->info("{$user_id}が{$other_user_id}をフォロー解除しました。");
            }
        }
    }
}
