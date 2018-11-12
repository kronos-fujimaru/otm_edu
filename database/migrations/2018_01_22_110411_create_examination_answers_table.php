<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExaminationAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::create('examination_answers', function (Blueprint $table) {
             $table->increments('id');
             $table->integer('examination_problem_id');
             $table->integer('examination_score_id');
             $table->text('answer');
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
         Schema::drop('examination_answers');
     }
}
