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
        Schema::create('posts', function (Blueprint $table) 
        {
            $table->bigIncrements('id'); // 投稿ID（自動採番）
            $table->unsignedBigInteger('user_id')->index(); // ユーザーID（外部キー + 検索高速化）
            $table->string('content', 140); // 投稿内容（最大140文字）
            $table->timestamps(); // created_at, updated_at
            $table->softDeletes(); // ソフトデリート（論理削除）

            // 外部キー制約
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

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