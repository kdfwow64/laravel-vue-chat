<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScheduleMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('schedule_id');
            $table->unsignedInteger('message_id');
            $table->integer('repeat');
            $table->string('frequency');
            $table->date('start_date');
            $table->date('end_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->date('repeat_end');
            $table->integer('every');
            $table->string('dow');
            $table->string('dom');
            $table->string('month_weekend_turn');
            $table->string('month_weekend_day');
            $table->string('doy');
            $table->string('year_weekend_turn');
            $table->string('year_weekend_day');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedule_messages');
    }
}
