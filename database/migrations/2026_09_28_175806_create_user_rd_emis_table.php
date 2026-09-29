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
        Schema::create('user_rd_emis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_rd_id')->constrained('user_rds')->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('installment_number');
            $table->decimal('amount', 10, 2);
            $table->date('due_date');
            $table->string('status')->default('pending'); // paid, pending, overdue
            $table->date('payment_date')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('payment_screenshot')->nullable();
            $table->string('payment_method')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_rd_emis');
    }
};
