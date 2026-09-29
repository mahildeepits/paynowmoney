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
        Schema::create('user_kycs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('aadhar_no')->nullable();
            $table->string('aadhar_front')->nullable();
            $table->string('aadhar_back')->nullable();
            $table->tinyInteger('aadhar_status')->default(0)->comment('0=Pending, 1=Approved, 2=Rejected');
            $table->text('aadhar_reject_reason')->nullable();
            $table->string('pan_no')->nullable();
            $table->string('pan_front')->nullable();
            $table->string('pan_back')->nullable();
            $table->tinyInteger('pan_status')->default(0)->comment('0=Pending, 1=Approved, 2=Rejected');
            $table->text('pan_reject_reason')->nullable();
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_kycs');
    }
};
