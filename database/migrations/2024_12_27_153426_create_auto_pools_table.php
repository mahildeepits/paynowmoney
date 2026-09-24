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
        Schema::create('auto_pools', function (Blueprint $table) {
            $table->id();
            $table->string( 'name');
            $table->decimal( 'count_4')->default(0);
            $table->decimal( 'count_16')->default(0);
            $table->decimal( 'count_64')->default(0);
            $table->decimal( 'count_256')->default(0);
            $table->decimal( 'count_1024')->default(0);
            $table->decimal( 'count_4096')->default(0);
            $table->decimal( 'count_16384')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auto_pools');
    }
};
