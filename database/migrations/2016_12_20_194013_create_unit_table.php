<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnitTable extends Migration
{
    
    public function up()
    {
        Schema::create('unit', function (Blueprint $table) {
            $table->increments('idUnit');

            $table->string('name', 100);
            $table->string('legalCode', 3);
        });
    }

    public function down()
    {
        Schema::drop('unit');
    }
    
}
