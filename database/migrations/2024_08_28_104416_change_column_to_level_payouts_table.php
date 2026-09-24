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
        Schema::table('level_payouts', function (Blueprint $table) {
            if(Schema::hasColumn('level_payouts','payout_of_user')){
                $table->renameColumn('payout_of_user','level');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('level_payouts', function (Blueprint $table) {
            //
        });
    }
};
