<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActiveLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       // 用于统计 激活邮箱 请求的 记录 和 Token 
         Schema::create('active_log', function (Blueprint $table) { 
          $table->increments('id');  
          $table->string('email')->unique()->comment('需要激活的邮箱');
          $table->string('token')->comment('放在发送邮件中的 Url 的后缀，用以唯一识别一个激活操作');
         $table->timestamp('created_at')->comment('申请激活的时间'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
