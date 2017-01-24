<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProFormaTable extends Migration
{
    
    public function up()
    {
        Schema::create('proForma', function (Blueprint $table) {
            $table->increments('idProForma');

            $table->datetime('registerDate');
            $table->double('totalAmount', 15, 2);

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
        Schema::drop('proForma');
    }
}
