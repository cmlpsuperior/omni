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
            $table->double('discount',15,2);
            $table->double('freight',15,2);
                      
            $table->double('totalAmount', 15, 2);
            
            $table->integer('idClient')->unsigned()->nullable();
            $table->integer('idZone')->unsigned();
            $table->integer('idEmployee')->unsigned();
            $table->char('idMoneyType',3); //PEN or USD

            $table->foreign('idClient')->references('idClient')->on('client');
            $table->foreign('idZone')->references('idZone')->on('zone');
            $table->foreign('idEmployee')->references('idEmployee')->on('employee');
            $table->foreign('idMoneyType')->references('idMoneyType')->on('moneyType');
        });
    }

    
    public function down()
    {
        Schema::drop('proForma');
    }
}
