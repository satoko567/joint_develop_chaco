<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email')->unique();
            $table->string('nickname')->unique();
            $table->string('password');            
            $table->enum('gender', ['male', 'female', 'other','unknown'])->default('unknown');
            $table->string('profile_picture')->nullable(); // デフォルト写真を管理
            $table->text('self_introduction')->nullable(); // 自己紹介用カラムを追加
            $table->timestamps();
            $table->softDeletes();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
