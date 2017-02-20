<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoletaFacturaTable extends Migration
{
    public function up()
    {
        Schema::create('boletaFactura', function (Blueprint $table) {
            $table->engine = 'MyISAM';

            $table->char('letter',1); //F, B
            $table->char('serie',3); //store number
            $table->integer('number')->unsigned();

            $table->datetime('registerDate');
            $table->string('documentNumber',20);
            $table->string('names',100);
            
            $table->double('igv',15,2);
            $table->string('state', 30);

            $table->integer('idVoucherType')->unsigned();
            $table->integer('idSale')->unsigned()->unique();

            $table->primary(['letter', 'serie', 'number']);
            $table->foreign('idVoucherType')->references('idVoucherType')->on('voucherType');
            $table->foreign('idSale')->references('idSale')->on('sale');
        });

        DB::statement('ALTER TABLE boletaFactura MODIFY number INTEGER NOT NULL AUTO_INCREMENT');
    }

    
    public function down()
    {
        Schema::drop('boletaFactura');
    }
}
