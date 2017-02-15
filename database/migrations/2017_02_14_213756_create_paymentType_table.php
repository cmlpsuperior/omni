<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentTypeTable extends Migration
{
    public function up()
    {
        Schema::create('paymentType', function (Blueprint $table) {
            $table->increments('idPaymentType');

            $table->string('name', 50);
            $table->string('description', 200);
            $table->string('state', 50);
        });
    }

    
    public function down()
    {
        Schema::drop('paymentType');
    }
}
