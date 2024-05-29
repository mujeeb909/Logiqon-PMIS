<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'invoice_payments', function (Blueprint $table){
            $table->bigIncrements('id');
            $table->integer('invoice_id');
            $table->date('date');
            $table->float('amount')->default('0.00');
            $table->integer('account_id')->default(0);
            $table->integer('payment_method')->default(0);
            $table->string('reference')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_payments');
    }
}
