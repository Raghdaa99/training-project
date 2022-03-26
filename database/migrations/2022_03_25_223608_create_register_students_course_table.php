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
        Schema::create('register_students_course', function (Blueprint $table) {
            $table->id();

            $table->foreignId('student_no');
            $table->foreign('student_no')->references('student_no')->on('students');

            $table->foreignId('department_no');
            $table->foreign('department_no')->references('department_no')->on('departments');

            $table->foreignId('supervisor_no');
            $table->foreign('supervisor_no')->references('supervisor_no')->on('supervisors');

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
        Schema::dropIfExists('register_students_course');
    }
};
