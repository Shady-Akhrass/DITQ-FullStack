<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('competition_applications', function (Blueprint $table) {
            $table->id();
            $table->string('student_name');
            $table->integer('age');
            $table->string('mobile_number');
            $table->string('whatsapp_number');
            $table->string('governorate');
            $table->text('address');
            $table->string('memorizer_name');
            $table->string('participation_field');
            $table->string('video_path')->nullable();
            $table->string('video_link')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competition_applications');
    }
};
