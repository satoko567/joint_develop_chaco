<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder_J extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            ['name' => 'masa', 'gender' => 'male'],
            ['name' => 'yurika', 'gender' => 'female'],
            ['name' => 'jin', 'gender' => 'male'],
            ['name' => 'laravel', 'gender' => 'other'],
            ['name' => 'joint', 'gender' => 'unknown'],
        ];
        
        foreach ($users as $user) {
            DB::table('users')->insert([
                'nickname' => $user['name'],
                'email' => $user['name'] . '@test.com',
                'password' => 'Laravel', // 固定値として
                'gender' => $user['gender'],
            ]);
        }
        
    }
}