<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfoInitLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('info_init_logs', function (Blueprint $table) {
          // 创建一个表用于记录个人信息初始化完成到哪一步 
          $table->increments('id');
          $table->integer('user_id')->unqiue()->comment('用户 id');
          $table->integer('step')->defalut(0)->comment(' 0 表示为未开始，1,2,3... 分别对应着 1,2,3... 步');
          // 1. 完善基本信息 2.选择私有信息 3. 上传头像 4. 添加社交链接。
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
        Schema::table('info_init_log', function (Blueprint $table) {
            //
        });
    }
}
