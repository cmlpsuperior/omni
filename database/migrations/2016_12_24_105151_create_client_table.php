<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientTable extends Migration
{
    
    public function up()
    {
        Schema::create('client', function (Blueprint $table) {
            $table->increments('idClient');

            $table->string('names', 100);
            $table->string('fatherLastName', 100);
            $table->string('motherLastName', 100);

            $table->datetime('birthdate')->nullable();
            $table->string('documentNumber',20)->unique();
            $table->string('email', 100)->nullable()->unique();

            $table->string('gender', 50);
            $table->string('phone', 20)->nullable();
            $table->datetime('registerDate');

            $table->integer('idDocumentType')->unsigned();

            $table->foreign('idDocumentType')->references('idDocumentType')->on('documentType');
        });
    }

    public function down()
    {
        Schema::drop('client');
    }
}
