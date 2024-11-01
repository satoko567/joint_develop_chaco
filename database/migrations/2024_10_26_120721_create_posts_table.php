<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->bigInteger('user_id')->unsigned()->index(); // user_idがマイナスにならないように/user_idカラムへの検索速度を早める
            $table->string('content, 140');
            $table->timestamps();
            $table->softDeletes(); 
            // 外部キー制約
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // postsテーブルのuser_idカラムとusersテーブルのidカラムは一致しなければならない/userが削除されれば,所有しているpostsも削除される
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
