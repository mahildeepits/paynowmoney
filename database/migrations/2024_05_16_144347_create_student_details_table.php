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
        Schema::create('student_details', function (Blueprint $table) {
            $table->id();
            $table->string('profile_picture')->nullable();
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('course_id')->index();
            $table->string('father_name');
            $table->string('mother_name');
            $table->text('address');
            $table->double('phone');
            $table->unsignedBigInteger('country')->index();
            $table->unsignedBigInteger('district')->index();
            $table->string('aadhaar_no');
            $table->string('language',50);
            $table->string('qualification');
            $table->string('class_type',50);
            $table->string('class_center',50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_details');
    }
};
