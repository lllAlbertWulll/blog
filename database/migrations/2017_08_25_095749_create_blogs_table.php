<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');                                    // 标题
            $table->text('body');                                       // 内容
            $table->integer('user_id')->unsigned();                     // 用户编号
            $table->string('close_comment',8)->default('F');   // 是否关闭评论功能
            $table->string('is_hidden',8)->default('F');       // 是否隐藏
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
        Schema::dropIfExists('blogs');
    }
}
