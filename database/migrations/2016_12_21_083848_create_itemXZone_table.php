<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemXZoneTable extends Migration
{
    
    public function up()
    {
        Schema::create('itemXZone', function (Blueprint $table) {
            $table->integer('idItem')->unsigned();
            $table->integer('idZone')->unsigned();

            $table->double('price', 15,2);

            //define the primary keys:
            $table->primary(['idItem', 'idZone']);

            //define the foreign keys
            $table->foreign('idItem')->references('idItem')->on('item');
            $table->foreign('idZone')->references('idZone')->on('zone');
        });
    }

   
    public function down()
    {
        Schema::drop('itemXZone');
    }
}
