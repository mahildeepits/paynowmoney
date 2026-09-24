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
        Schema::table('admin_charges', function (Blueprint $table) {
            $table->decimal('activation_fee', 10, 2)->default(2500)->after('first_sale_entry_amount');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admin_charges', function (Blueprint $table) {
            $table->dropColumn('activation_fee');
        });
    }
};
