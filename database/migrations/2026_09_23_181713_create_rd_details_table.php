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
        Schema::create('rd_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rd_master_id')->constrained('rd_masters')->onDelete('cascade');
            $table->decimal('emi_amount', 10, 2);
            $table->integer('months');
            $table->decimal('return_percentage', 5, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rd_details');
    }
};
