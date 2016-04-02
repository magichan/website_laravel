<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNormalAttrUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
          // 添加基本的属性
            $table->boolean('email_authority')->default(true);
 
            $table->enum('sex',['male','female']);
            $table->boolean('sex_authority')->default(true);

            $table->string('address',100);
            $table->boolean('address_authority')->default(true);
            
            $table->string('admission_year',6);
            $table->boolean('admission_authority')->default(true);

            $table->string('tel');
            $table->boolean('tel_authority')->default(true);

            $table->string('photo');
            $table->boolean('photo_authority')->default(true);

            /* student */
            $table->string('class');
            $table->boolean('class_authority')->default(true);

            $table->string("group");
            $table->boolean('group_authority')->default(true);
         
            /* graduate */
            $table->string('company');
            $table->boolean('company_authority')->default(true);

            $table->string('position');
            $table->boolean('position_authority')->default(true);

            $table->enum('status',['student','graduate','delete'])->defalut('student');
            $table->boolean('active')->default(false);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
