<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('comments', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->text('body');
        
        // user_idとpost_idをunsignedBigIntegerで設定
        $table->unsignedBigInteger('user_id')->nullable()->change();
        $table->unsignedBigInteger('post_id');
        
        $table->timestamps();
        $table->softDeletes();

        // 外部キー制約を追加
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable(false)->change(); // 元に戻す
        });
    }
}
