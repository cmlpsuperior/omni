<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoneyTypeTable extends Migration
{
    public function up()
    {
        Schema::create('moneyType', function (Blueprint $table) {
            $table->char('idMoneyType',3);
            
            $table->string('name');
            $table->primary(['idMoneyType']);
        });
    }

    
    public function down()
    {
        Schema::drop('moneyType');
    }
}
