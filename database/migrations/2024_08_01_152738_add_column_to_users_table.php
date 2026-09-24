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
            if(!Schema::hasColumn('users','kit_id')){
                $table->unsignedBigInteger('kit_id')->nullable()->after('user_icon');
                $table->foreign('kit_id')->references('id')->on('joining_kits')->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if(!Schema::hasColumn('users','kit_id')){
                $table->dropForeign('kit_id');
                $table->dropColumn('kit_id');
            }
        });
    }
};
