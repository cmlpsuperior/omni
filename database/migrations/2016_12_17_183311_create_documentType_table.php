<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentTypeTable extends Migration
{
    
    public function up()
    {
        Schema::create('documentType', function (Blueprint $table) {
            $table->char('idDocumentType',1);

            $table->string('name', 50);
            $table->string('type', 50);

            $table->primary(['idDocumentType']);
        });
    }

    public function down()
    {
        Schema::drop('documentType');
    }
}
