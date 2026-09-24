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
        Schema::create('epin_history', function (Blueprint $table) {
            $table->id();
            $table->integer('joining_kit')->index();
            $table->integer('pin_no')->index();
            $table->integer('transfer_from')->index();
            $table->integer('transfer_to')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('epin_history');
    }
};
