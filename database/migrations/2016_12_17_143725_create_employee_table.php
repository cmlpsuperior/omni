<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeTable extends Migration
{    
    public function up()
    {
        Schema::create('employee', function (Blueprint $table) {
            $table->increments('idEmployee');

            $table->string('names');
            $table->string('fatherLastName');
            $table->string('motherLastName');

            $table->datetime('birthdate');
            $table->string('documentType')->unique();
            $table->string('email')->unique();

            $table->string('state');
            $table->string('gender');
            $table->integer('phone')->nullable();

            $table->datetime('entryDate');
            $table->datetime('endDate')->nullable();

            $table->integer('idDocumentType');
            $table->integer('idDriverLicense')->nullable();
            $table->integer('idUser');
        });
    }

    public function down()
    {
        Schema::drop('employee');
    }
}
