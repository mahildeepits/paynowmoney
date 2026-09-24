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
        Schema::table('joining_kits', function (Blueprint $table) {
            if (!Schema::hasColumn('joining_kits', 'direct_income')) {
                $table->string('direct_income')->default(0);
            }
            if (!Schema::hasColumn('joining_kits', 'bonus_amount')) {
                $table->string('bonus_amount')->default(0);
            }
            if (!Schema::hasColumn('joining_kits', 'level2_5')) {
                $table->string('level2_5')->default(0)->comment('Level Income');
            }
            if (!Schema::hasColumn('joining_kits', 'level6_15')) {
                $table->string('level6_15')->default(0)->comment('Level Income');
            }
            if (!Schema::hasColumn('joining_kits', 'level16_25')) {
                $table->string('level16_25')->default(0)->comment('Level Income');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('joining_kits', function (Blueprint $table) {
            if(Schema::hasColumn('joining_kits', 'direct_income')){
                $table->dropColumn('direct_income');
            }
            if(Schema::hasColumn('joining_kits', 'bonus_amount')){
                $table->dropColumn('bonus_amount');
            }
            if(Schema::hasColumn('joining_kits', 'level2_5')){
                $table->dropColumn('level2_5');
            }
            if(Schema::hasColumn('joining_kits', 'level6_15')){
                $table->dropColumn('level6_15');
            }
            if(Schema::hasColumn('joining_kits', 'level16_25')){
                $table->dropColumn('level16_25');
            }
        });
    }
};
