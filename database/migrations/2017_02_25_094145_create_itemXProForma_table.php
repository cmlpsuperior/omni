<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemXProFormaTable extends Migration
{
    public function up()
    {
        Schema::create('itemXProForma', function (Blueprint $table) {
            $table->integer('idProForma')->unsigned();
            $table->integer('idItem')->unsigned();

            $table->integer('orderNumber')->unsigned();
            $table->double('quantity', 15,3);
            $table->double('unitPrice', 15,2);

            //define the primary keys:
            $table->primary(['idProForma', 'idItem']);

            //define the foreign keys
            $table->foreign('idProForma')->references('idProForma')->on('proForma');
            $table->foreign('idItem')->references('idItem')->on('item');
        });
    }

    
    public function down()
    {
        Schema::drop('itemXProForma');
    }
}
