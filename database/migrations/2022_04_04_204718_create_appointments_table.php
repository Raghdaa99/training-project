<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->date('start_date');
            $table->date('end_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->binary('Saturday');
            $table->binary('Sunday');
            $table->binary('Monday');
            $table->binary('Tuesday');
            $table->binary('Wednesday');
            $table->binary('Thursday');
            $table->foreignId('student_no');
            $table->foreign('student_no')->references('student_no')->on('students_company_field');
            $table->integer('no_hours_of_training');
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
        Schema::dropIfExists('appointments');
    }
};
