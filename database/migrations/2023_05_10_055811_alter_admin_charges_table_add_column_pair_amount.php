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
            $table->integer('pair_amount')->after('direct_amount')->default(0);
            $table->integer('capping_of_pair')->after('pair_amount')->default(0);
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
            $table->dropColumn('pair_amount');
            $table->dropColumn('capping_of_pair');
        });
    }
};
