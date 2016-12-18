<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDriverLicenseTable extends Migration
{
    
    public function up()
    {
        Schema::create('driverLicense', function (Blueprint $table) {
            $table->increments('idDriverLicense');

            $table->string('name', 50);
            $table->string('description', 200);

            
        });
    }
    
    public function down()
    {
        Schema::drop('driverLicense');
    }
}
