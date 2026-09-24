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
        Schema::create('wallet_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('keyword')->nullable()->comment('transfer | buy_pin | self_transfer_(type)');
            $table->string('transfered_to')->nullable();
            $table->double('amount')->default(0);
            $table->double('tds')->default(0);
            $table->double('admin_charges')->default(0);
            $table->double('net_amount')->default(0);
            $table->string('pin_no')->nullable();
            $table->boolean('status')->default(1);
            $table->boolean('is_paid')->default(0);
            $table->dateTime('is_requested')->nullable();
            $table->string('transaction_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallet_transactions');
    }
};
