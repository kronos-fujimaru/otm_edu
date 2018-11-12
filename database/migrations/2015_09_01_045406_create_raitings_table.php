<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRaitingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raitings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('participant_id');
            $table->integer('skill_a');
            $table->integer('skill_b');
            $table->integer('skill_c');
            $table->integer('skill_d');
            $table->integer('skill_e');
            $table->integer('skill_f');
            // $table->date('date');
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
        Schema::drop('raitings');
    }
}
