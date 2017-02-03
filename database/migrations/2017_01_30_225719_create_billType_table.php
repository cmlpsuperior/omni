<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillTypeTable extends Migration
{

    public function up()
    {
        Schema::create('billType', function (Blueprint $table) {
            $table->increments('idBillType');

            $table->string('name', 50);
            $table->string('description', 200);
            $table->string('state', 50);
        });
    }

    public function down()
    {
        Schema::drop('billType');
    }
}
