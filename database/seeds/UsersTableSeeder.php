<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [];

        // 一般ユーザーを2件登録
        for ($i = 0; $i < 2; $i++) {
            $name = Str::random(6);
            $users[] = [
                'name' => $name,
                'email' => $name . '@sample.com',
                'password' => Hash::make('password'),
                'is_admin' => false,
            ];
        }

        // 管理者ユーザーを1件登録
        $users[] = [
            'name' => 'admin',
            'email' => 'admin@sample.com',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ];

        DB::table('users')->insert($users);
    }
}
