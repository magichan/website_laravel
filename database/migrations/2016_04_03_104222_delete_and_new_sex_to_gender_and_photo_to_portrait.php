<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteAndNewSexToGenderAndPhotoToPortrait extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
           $table->dropColumn('sex');
           $table->dropColumn('sex_authority'); 
          $table->dropColumn('photo');
          $table->dropColumn('photo_authority');
            $table->enum('gender',['male','female']);
            $table->boolean('gender_authority')->default(true);
            $table->string('portrait')->comment("照片链接");
            $table->boolean('portrait_authority')->default(true);
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
