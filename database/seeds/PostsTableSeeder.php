<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = DB::table('users')->get();
        foreach ($users as $user) {
            DB::table('posts')->insert([
                [
                    'user_id' => $user->id,
                    'shop_name' => 'コーヒー整備工場',
                    'address' => '新潟県三条市カフェ通り1-1',
                    'content' => 'コーヒー整備工場の接客はとても親切だ',
                ],
                [
                    'user_id' => $user->id,
                    'shop_name' => '青空モーターズ',
                    'address' => '新潟県三条市晴れ町2-2',
                    'content' => '青空モーターズは安価で安心な整備工場だ',
                ],
                [
                    'user_id' => $user->id,
                    'shop_name' => 'にくにくオート',
                    'address' => '新潟県三条市焼肉通り3-3',
                    'content' => 'にくにくオートは修理の技術がとても高くて素晴らしい',
                ],
            ]);
        }
    }
}