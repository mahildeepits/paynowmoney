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
        Schema::create('user_payouts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('income_type')->nullable();
            $table->decimal('amount')->default(0);
            $table->decimal('tds')->default(0);
            $table->decimal('admin_charges')->default(0);
            $table->decimal('net_amount')->default(0);
            $table->timestamp('is_requested')->nullable();
            $table->timestamp('is_paid')->nullable();
            $table->string('transaction_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_payouts');
    }
};
