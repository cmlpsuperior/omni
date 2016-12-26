<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemXOrderTable extends Migration
{
    
    public function up()
    {
        Schema::create('itemXOrder', function (Blueprint $table) {
            $table->integer('idOrder')->unsigned();
            $table->integer('idItem')->unsigned();

            $table->double('quantity', 15,2);
            $table->double('unitPrice', 15,2);

            //define the primary keys:
            $table->primary(['idOrder', 'idItem']);

            //define the foreign keys
            $table->foreign('idOrder')->references('idOrder')->on('order');
            $table->foreign('idItem')->references('idItem')->on('item');
        });
    }

    
    public function down()
    {
        Schema::drop('itemXOrder');
    }
}
