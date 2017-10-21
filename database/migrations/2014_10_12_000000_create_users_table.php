<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');                           // 用户id
            $table->string('name')->unique();                   // 用户名
            $table->string('email')->unique();                  // 用户邮箱
            $table->string('password');                         // 用户密码
            $table->string('avatar');                           // 用户头像
            $table->string('confirmation_token');               // token 值
            $table->smallInteger('is_active')->default(0);      // 判断邮箱是否被激活
            $table->integer('articles_count')->default(0);      // 文章数
            $table->json('settings')->nullable();               //
            $table->rememberToken();
            $table->timestamps();
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
