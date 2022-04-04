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
        Schema::create('students_company_field', function (Blueprint $table) {
            $table->id();

            $table->foreignId('student_no');
            $table->foreign('student_no')->references('student_no')->on('register_students_course');

            $table->foreignId('field_id');
            $table->foreign('field_id')->references('id')->on('fields');

            $table->foreignId('company_id');
            $table->foreign('company_id')->references('id')->on('companies');


            $table->boolean('status')->default(false);

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
        Schema::dropIfExists('students_company_field');
    }
};
