<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZoneTable extends Migration
{
    
    public function up()
    {
        Schema::create('zone', function (Blueprint $table) {
            $table->increments('idZone');

            $table->string('name', 100);
            $table->double('shipping', 15,2);
            $table->string('state', 50);
        });
    }

    public function down()
    {
        Schema::drop('zone');
    }
}
