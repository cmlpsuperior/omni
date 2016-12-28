<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressTable extends Migration
{
    
    public function up()
    {
        Schema::create('address', function (Blueprint $table) {
            $table->increments('idAddress');

            $table->string('address', 100);
            $table->string('reference', 100)->nullable();
            $table->datetime('registerDate');

            $table->string('latitude', 50)->nullable();
            $table->string('longitude', 50)->nullable();

            $table->integer('idClient')->unsigned();
            $table->integer('idZone')->unsigned();

            $table->foreign('idClient')->references('idClient')->on('client');
            $table->foreign('idZone')->references('idZone')->on('zone');
        });
    }

    public function down()
    {
        Schema::drop('address');
    }
}
