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
        Schema::table('emis', function (Blueprint $table) {
            $table->unsignedBigInteger('user_loan_id')->nullable()->after('user_id');
            $table->integer('emi_number')->nullable()->after('amount');
            $table->date('due_date')->nullable()->after('emi_number');

            $table->foreign('user_loan_id')->references('id')->on('user_loans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('emis', function (Blueprint $table) {
            $table->dropForeign(['user_loan_id']);
            $table->dropColumn(['user_loan_id', 'emi_number', 'due_date']);
        });
    }
};
