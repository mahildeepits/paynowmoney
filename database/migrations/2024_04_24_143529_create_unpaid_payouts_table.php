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
        Schema::create('unpaid_payouts', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('tree');
            $table->integer('pair_count');
            $table->double('pair_amount');
            $table->double('direct_income');
            $table->double('tds');
            $table->double('admin_charge');
            $table->double('net_amount');
            $table->string('credit_or_cut');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unpaid_payouts');
    }
};
