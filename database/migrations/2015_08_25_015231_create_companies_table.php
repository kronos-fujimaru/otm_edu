<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::create('companies', function (Blueprint $table) {
             $table->increments('id');
             $table->string('name');
             $table->string('url');
             $table->integer('kronos')->default(0); // 0:other 1:kronos
             $table->softDeletes();
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
         Schema::drop('companies');
     }
}
