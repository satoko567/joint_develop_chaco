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
        //usersテーブルにデータを2件登録
        $users = [];
        $icons = ['icon_1.png','icon_2.png','icon_3.png','icon_4.png'];

        for ($i = 0; $i < 2; $i++) {
            $name = Str::random(6);
            $users[] = [
                'name' => $name,
                'email' => $name . '@sample.com',
                'icon' => $icons[array_rand($icons)],
                'password' => Hash::make('password'),
            ];
        }

        DB::table('users')->insert($users);
    }
}
