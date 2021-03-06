<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePositionTable extends Migration
{
    
    public function up()
    {
        Schema::create('position', function (Blueprint $table) {
            $table->increments('idPosition');

            $table->string('name', 50);
            $table->string('description', 200);
        });
    }

    public function down()
    {
        Schema::drop('position');
    }
}
