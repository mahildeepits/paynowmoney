<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fd_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fd_master_id')->constrained('fd_masters')->onDelete('cascade');
            $table->decimal('amount', 15, 2);
            $table->integer('months');
            $table->decimal('return_percentage', 5, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fd_details');
    }
};
