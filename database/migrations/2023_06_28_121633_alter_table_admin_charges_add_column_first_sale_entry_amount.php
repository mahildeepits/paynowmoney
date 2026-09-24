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
        Schema::table('admin_charges', function(Blueprint $table){
            $table->integer('first_sale_entry_amount')->after('capping_of_pair')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admin_charges', function(Blueprint $table){
            $table->dropColumn('first_sale_entry_amount');
        });
    }
};
