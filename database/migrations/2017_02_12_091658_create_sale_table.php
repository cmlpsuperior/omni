<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleTable extends Migration
{
    public function up()
    {
        Schema::create('sale', function (Blueprint $table) {
            $table->increments('idSale');

            $table->datetime('registerDate');
            $table->double('discount',15,2);
            $table->double('freight',15,2);
            
            $table->double('totalAmount', 15, 2);
            $table->string('state', 50);            
            $table->string('observations', 250)->nullable();
            
            $table->integer('idClient')->unsigned()->nullable();
            $table->integer('idZone')->unsigned();
            $table->integer('idEmployee')->unsigned();

            $table->foreign('idClient')->references('idClient')->on('client');
            $table->foreign('idZone')->references('idZone')->on('zone');
            $table->foreign('idEmployee')->references('idEmployee')->on('employee');
        });
    }

    
    public function down()
    {
        Schema::drop('sale');
    }
}