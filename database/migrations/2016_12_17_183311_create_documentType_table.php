<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentTypeTable extends Migration
{
    
    public function up()
    {
        Schema::create('documentType', function (Blueprint $table) {
            $table->increments('idDocumentType');

            $table->string('name', 50);
            $table->string('description', 200);
            $table->string('type', 50);
        });
    }

    public function down()
    {
        Schema::drop('documentType');
    }
}
