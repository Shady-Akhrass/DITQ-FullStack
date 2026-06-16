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
        Schema::create('homes', function (Blueprint $table) {
            $table->id();
            $table->string('vision', 1000);
            $table->string('mission', 1000);
            $table->string('student_number');
            $table->string('lesson_number');
            $table->string('memorizing_number');
            $table->string('teacher_number');
            $table->string('course_number');
            $table->string('camp_number');
            $table->string('contest_number');
            $table->string('celebration_number');
            $table->bigInteger('visitors')->default(0);
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
        Schema::dropIfExists('homes');
    }
};
