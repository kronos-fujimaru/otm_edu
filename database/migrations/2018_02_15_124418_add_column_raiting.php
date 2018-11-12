<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnRaiting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('raitings', function (Blueprint $table) {
          $table->text('title')->after('participant_id');
          $table->text('skill_a_comment')->after('skill_a');
          $table->text('skill_b_comment')->after('skill_b');
          $table->text('skill_c_comment')->after('skill_c');
          $table->text('skill_d_comment')->after('skill_d');
          $table->text('skill_e_comment')->after('skill_e');
          $table->text('skill_f_comment')->after('skill_f');
          $table->text('comment')->after('skill_f_comment');
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
