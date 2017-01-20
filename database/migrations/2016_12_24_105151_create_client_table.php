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

            $table->string('names', 100)->nullable();
            $table->string('fatherLastName', 100)->nullable();
            $table->string('motherLastName', 100)->nullable();

            $table->datetime('birthdate')->nullable();
            $table->string('documentNumber',20)->unique(); //could be RUC comp
            $table->string('email', 100)->nullable()->unique(); // comp

            $table->string('gender', 50)->nullable(); 
            $table->string('phone', 20)->nullable(); // comp
            $table->datetime('registerDate'); // comp

            $table->string('businessName', 100)->nullable(); // comp

            $table->integer('idDocumentType')->unsigned(); // comp

            $table->foreign('idDocumentType')->references('idDocumentType')->on('documentType');
        });
    }

    public function down()
    {
        Schema::drop('client');
    }
}
