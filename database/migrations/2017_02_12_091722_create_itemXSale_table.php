<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemXSaleTable extends Migration
{
    public function up()
    {
        Schema::create('itemXSale', function (Blueprint $table) {
            $table->integer('idSale')->unsigned();
            $table->integer('idItem')->unsigned();

            $table->integer('orderNumber')->unsigned();
            $table->double('quantity', 15,3);
            $table->double('unitPrice', 15,2);

            //define the primary keys:
            $table->primary(['idSale', 'idItem']);

            //define the foreign keys
            $table->foreign('idSale')->references('idSale')->on('sale');
            $table->foreign('idItem')->references('idItem')->on('item');
        });
    }

    
    public function down()
    {
        Schema::drop('itemXSale');
    }
}
