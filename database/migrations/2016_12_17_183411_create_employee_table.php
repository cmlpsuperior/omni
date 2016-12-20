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

            $table->string('names', 100);
            $table->string('fatherLastName', 100);
            $table->string('motherLastName', 100);

            $table->datetime('birthdate');
            $table->string('documentNumber',20)->unique();
            $table->string('email', 100)->nullable()->unique();

            $table->string('state', 50);
            $table->string('gender', 50);
            $table->string('phone', 20)->nullable();

            $table->datetime('entryDate');
            $table->datetime('endDate')->nullable();

            $table->integer('idDocumentType')->unsigned();
            $table->integer('idDriverLicense')->unsigned()->nullable();
            $table->integer('idPosition')->unsigned();
            $table->integer('idUser')->unsigned();


            $table->foreign('idDocumentType')->references('idDocumentType')->on('documentType');
            $table->foreign('idDriverLicense')->references('idDriverLicense')->on('driverLicense');
            $table->foreign('idPosition')->references('idPosition')->on('position');
            $table->foreign('idUser')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::drop('employee');
    }
}
