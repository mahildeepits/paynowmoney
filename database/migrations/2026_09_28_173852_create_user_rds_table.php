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
        Schema::create('user_rds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('rd_master_id')->constrained('rd_masters')->onDelete('cascade');
            $table->decimal('monthly_deposit', 10, 2);
            $table->integer('duration_months');
            $table->decimal('total_expected_return', 10, 2);
            $table->string('status')->default('pending_approval'); // pending_approval, active, completed, cancelled, rejected
            $table->string('payment_screenshot')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('transaction_id')->nullable();
            $table->text('admin_remarks')->nullable();
            $table->date('start_date')->nullable();
            $table->date('maturity_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_rds');
    }
};
