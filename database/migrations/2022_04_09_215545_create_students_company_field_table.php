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
            $table->foreign('student_no')->references('student_no')->on('register_students_course')->onDelete('cascade');

            $table->foreignId('company_field_id');
            $table->foreign('company_field_id')->references('id')->on('companies_fields')->onDelete('cascade');

            $table->foreignId('trainer_id');
            $table->foreign('trainer_id')->references('id')->on('trainers')->onDelete('cascade');

            $table->boolean('status_company')->default(false);
            $table->boolean('status_supervisor')->default(false);

            $table->text('notes')->nullable();
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
