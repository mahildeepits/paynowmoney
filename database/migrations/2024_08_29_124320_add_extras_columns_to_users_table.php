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
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'customer_id')) {
                $table->string('customer_id')->nullable()->comment('Ecommerce Customer ID');
            }
            if (!Schema::hasColumn('users', 'last_coupon_date')) {
                $table->date('last_coupon_date')->nullable()->comment('Last Coupon Generated Date');
            }
            if (!Schema::hasColumn('users', 'total_months')) {
                $table->string('total_months')->nullable()->comment('Completed Months');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'customer_id')) {
                $table->dropColumn('customer_id');
            }
            if (Schema::hasColumn('users', 'last_coupon_date')) {
                $table->dropColumn('last_coupon_date');
            }
            if (Schema::hasColumn('users', 'total_months')) {
                $table->dropColumn('total_months');
            }
        });
    }
};
