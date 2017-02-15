<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalePaymentTable extends Migration
{
    public function up()
    {
        Schema::create('salePayment', function (Blueprint $table) {
            $table->increments('idSalePayment');

            $table->double('debtAmount', 15, 2);
            $table->double('receivedAmount', 15, 2);
            $table->datetime('registerDate');

            $table->integer('idSale')->unsigned();
            $table->integer('idEmployee')->unsigned();
            $table->integer('idPaymentType')->unsigned();
            $table->integer('idBankAccount')->unsigned()->nullable();

            $table->foreign('idSale')->references('idSale')->on('sale');
            $table->foreign('idEmployee')->references('idEmployee')->on('employee');
            $table->foreign('idPaymentType')->references('idPaymentType')->on('paymentType');
            $table->foreign('idBankAccount')->references('idBankAccount')->on('bankAccount');
        });
    }

    
    public function down()
    {
        Schema::drop('salePayment');
    }
}
