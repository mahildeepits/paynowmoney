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
        Schema::create('user_fds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('fd_master_id')->constrained('fd_masters')->onDelete('cascade');
            $table->decimal('amount', 15, 2);
            $table->integer('duration_months');
            $table->decimal('total_expected_return', 15, 2);
            $table->string('status')->default('pending_approval')->comment('pending_approval, active, rejected, completed');
            $table->string('payment_method')->nullable();
            $table->string('payment_screenshot')->nullable();
            $table->string('transaction_id')->nullable();
            $table->text('admin_remarks')->nullable();
            $table->date('start_date')->nullable();
            $table->date('maturity_date')->nullable();
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
        Schema::dropIfExists('user_fds');
    }
};
