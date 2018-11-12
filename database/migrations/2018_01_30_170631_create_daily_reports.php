<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDailyReports extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('participant_id');
            $table->date('date');
            $table->string('content', 2000);
            $table->integer('admin_approval_user_id');
            $table->integer('manager_approval_user_id');
            $table->integer('admin_approval_status');
            $table->string('admin_comment', 2000);
            $table->integer('manager_approval_status');
            $table->string('manager_comment', 2000);
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
        Schema::drop('daily_reports');
    }
}
