<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExaminationProblemsTable extends Migration
{
    public function up()
    {
        Schema::create('examination_problems', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('examination_id');
            $table->integer('no');
            $table->text('problem');
            $table->text('source');
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
        Schema::drop('examination_problems');
    }
}
