<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('trainings', function (Blueprint $table) {
          $table->increments('id');
          $table->string('title');
          $table->string('place');
          $table->date('date_from');
          $table->date('date_to');
          $table->integer('instructor_id');
          $table->integer('status');
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
      Schema::drop('trainings');
    }
}
