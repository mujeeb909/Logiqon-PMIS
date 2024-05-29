<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDiscountToPosProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pos_payments', function (Blueprint $table) {
            $table->float('discount')->nullable()->after('amount');
            $table->float('discount_amount')->nullable()->after('amount');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pos_payments', function (Blueprint $table) {
            //
        });
    }
}
