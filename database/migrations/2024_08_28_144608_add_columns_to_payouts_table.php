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
        Schema::table('payouts', function (Blueprint $table) {
            if (!Schema::hasColumn('payouts', 'level')) {
                $table->double('level')->nullable();
            }
            if (!Schema::hasColumn('payouts', 'level_income')) {
                $table->double('level_income')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payouts', function (Blueprint $table) {
            if(Schema::hasColumn('payouts', 'level')){
                $table->dropColumn('level');
            }
            if(Schema::hasColumn('payouts', 'level_income')){
                $table->dropColumn('level_income');
            }
        });
    }
};
