<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTable extends Migration
{
    
    public function up()
    {
        Schema::create('bill', function (Blueprint $table) {
            $table->increments('idBill');

            $table->string('name', 100)->nullable();
            $table->string('address', 100)->nullable();
            $table->string('phone', 100)->nullable();

            $table->string('documentNumber', 100)->nullable();
            $table->datetime('registerDate');
            $table->double('totalAmount', 15, 2);

            $table->double('receivedAmount', 15, 2);
            $table->string('state', 50);
            $table->string('observations', 250)->nullable();

            $table->integer('idClient')->unsigned()->nullable();
            $table->integer('idZone')->unsigned();
            $table->integer('idEmployee')->unsigned();
            $table->integer('idBillType')->unsigned();

            $table->foreign('idClient')->references('idClient')->on('client');
            $table->foreign('idZone')->references('idZone')->on('zone');
            $table->foreign('idEmployee')->references('idEmployee')->on('employee');
            $table->foreign('idBillType')->references('idBillType')->on('billType');
        });
    }

    
    public function down()
    {
        Schema::drop('bill');
    }
}
