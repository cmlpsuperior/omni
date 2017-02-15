<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankAccountTable extends Migration
{
    public function up()
    {
        Schema::create('bankAccount', function (Blueprint $table) {
            $table->increments('idBankAccount');

            $table->string('bankName', 100);
            $table->string('accountNumber', 50);
            $table->string('interbankAccountNumber', 100);
            $table->string('state', 50);
        });
    }

    
    public function down()
    {
        Schema::drop('bankAccount');
    }
}
