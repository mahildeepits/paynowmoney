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
            if(!Schema::hasColumn('joining_kits','autopool_id')){
                $table->unsignedBigInteger('autopool_id')->nullable();
                $table->foreign('autopool_id')->references('id')->on('auto_pools')->onDelete('cascade');
            }
            if(!Schema::hasColumn('joining_kits','upgrade_require_user_count')){
                $table->string('upgrade_require_user_count')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('joining_kits', function (Blueprint $table) {
            if(Schema::hasColumn('joining_kits','autopool_id')){
                $table->dropForeign(['autopool_id']);
                $table->dropColumn('autopool_id');
            }
            if(Schema::hasColumn('joining_kits','upgrade_require_user_count')){
                $table->dropColumn('upgrade_require_user_count');
            }
        });
    }
};
