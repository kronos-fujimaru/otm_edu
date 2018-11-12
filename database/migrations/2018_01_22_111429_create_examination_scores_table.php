<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExaminationScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::create('examination_scores', function (Blueprint $table) {
             $table->increments('id');
             $table->integer('examination_training_id');
             $table->integer('participant_id');
             $table->integer('score');
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
         Schema::drop('examination_scores');
     }
}
