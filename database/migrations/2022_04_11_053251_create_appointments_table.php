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
            $table->boolean('Saturday')->default(false);
            $table->boolean('Sunday')->default(false);
            $table->boolean('Monday')->default(false);
            $table->boolean('Tuesday')->default(false);
            $table->boolean('Wednesday')->default(false);
            $table->boolean('Thursday')->default(false);
            $table->foreignId('student_company_id');
            $table->foreign('student_company_id')->references('id')->on('students_company_field');
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
