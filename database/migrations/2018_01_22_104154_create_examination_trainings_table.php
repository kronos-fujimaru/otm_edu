<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExaminationTrainingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examination_trainings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('examination_id');
            $table->integer('training_id'); // to comapny
            $table->date('date');
            $table->integer('status');
            $table->softDeletes();
            $table->timestamps();
        });    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('examination_trainings');
    }
}
