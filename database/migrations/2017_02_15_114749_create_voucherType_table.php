<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoucherTypeTable extends Migration
{
    public function up()
    {
        Schema::create('voucherType', function (Blueprint $table) {
            $table->char('idVoucherType',2);
            
            $table->string('name');
            $table->boolean('forSale');

            $table->primary(['idVoucherType']);
        });
    }

    
    public function down()
    {
        Schema::drop('voucherType');
    }
}
