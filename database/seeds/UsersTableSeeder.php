<?php

use Illuminate\Database\Seeder;
use App\User; //追加

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 20)->create(); // 20人分のデータを作成
    }
}
