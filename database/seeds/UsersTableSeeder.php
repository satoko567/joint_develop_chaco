<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table ('users')->insert([
            [
                'name' => 'test1',
                'email' => 'test1@test.com',
                'password' => Hash::make ('test1')
            ],

            [
                'name' => 'test2',
                'email' => 'test2@test.com',
                'password' => Hash::make ('test2')
            ],

            [
                'name' => 'test3',
                'email' => 'test3@test.com',
                'password' => Hash::make ('test3')
            ],

            [
                'name' => 'test4',
                'email' => 'test4@test.com',
                'password' => Hash::make ('test4')
            ]
        ]);
    }
}
