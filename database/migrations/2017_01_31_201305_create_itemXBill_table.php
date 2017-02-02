<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemXBillTable extends Migration
{
    
    public function up()
    {
        Schema::create('itemXBill', function (Blueprint $table) {
            $table->integer('idBill')->unsigned();
            $table->integer('idItem')->unsigned();

            $table->double('quantity', 15,3);
            $table->double('unitPrice', 15,2);

            //define the primary keys:
            $table->primary(['idBill', 'idItem']);

            //define the foreign keys
            $table->foreign('idBill')->references('idBill')->on('bill');
            $table->foreign('idItem')->references('idItem')->on('item');
        });
    }

    
    public function down()
    {
        Schema::drop('itemXBill');
    }
}
