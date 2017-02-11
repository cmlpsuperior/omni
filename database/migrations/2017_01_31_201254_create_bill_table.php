<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillTable extends Migration
{
    
    public function up()
    {
        Schema::create('bill', function (Blueprint $table) {
            $table->increments('idBill');
            
            //anonimus client
            $table->string('documentNumber', 20)->nullable(); //person
            $table->string('name', 100)->nullable(); // person, company
            $table->string('legalAddress', 100)->nullable(); //company         
            
            $table->string('shippingAddress', 100)->nullable();
            $table->string('phone', 100)->nullable();
            $table->string('observations', 250)->nullable(); //when a bill is erased.

            $table->datetime('registerDate');
            $table->datetime('shippingDate')->nullable();
            $table->double('totalAmount', 15, 2);

            $table->double('receivedAmount', 15, 2)->nullable();
            $table->string('state', 50);

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
