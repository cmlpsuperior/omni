<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemTable extends Migration
{
    
    public function up()
    {
        Schema::create('item', function (Blueprint $table) {
            $table->increments('idItem');

            $table->string('name', 100);
            $table->double('price', 15,2);
            $table->string('state', 50);
            $table->double('realStock', 15, 2);
            $table->double('availableStock', 15, 2);

            $table->integer('idUnit')->unsigned();

            $table->foreign('idUnit')->references('idUnit')->on('unit');
        });
    }

    
    public function down()
    {
        Schema::drop('item');
    }
    
}
