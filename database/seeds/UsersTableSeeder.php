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

        for ($i = 0; $i < 2; $i++) {
            $name = Str::random(6);
            $users[] = [
                'name' => $name,
                'email' => $name . '@sample.com',
                'password' => Hash::make('password'),
            ];
        }

        DB::table('users')->insert($users);
    }
}
