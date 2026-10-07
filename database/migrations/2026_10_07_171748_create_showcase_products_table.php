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
        Schema::create('showcase_products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('mrp', 10, 2);
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->boolean('status')->default(true); // To allow admin to hide products
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('showcase_products');
    }
};
