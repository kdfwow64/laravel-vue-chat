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
            $table->unsignedInteger('account_id');
            $table->integer('schedule_id');
            $table->string('sender')->index();
            $table->string('receiver')->index();
            $table->integer('repeat');
            $table->string('frequency');
            $table->date('start_date');
            $table->date('end_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->date('repeat_end');
            $table->date('last_date');
            $table->integer('every');
            $table->integer('every_t');
            $table->string('dow');
            $table->string('dom');
            $table->string('month_weekend_turn');
            $table->string('month_weekend_day');
            $table->string('doy');
            $table->string('year_weekend_turn');
            $table->string('year_weekend_day');
            $table->string('text');
            $table->integer('flag');
            $table->integer('flagE');

        //    $table->foreign('account_id')->references('id')->on('accounts')->onUpdate('cascade')->onDelete('cascade');
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
