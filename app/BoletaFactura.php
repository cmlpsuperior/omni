<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BoletaFactura extends Model
{
    protected $table='boletaFactura';

    protected $primaryKey = ['letter','serie','number'];

    public $timestamps=false;

    protected $fillable = [
        'registerDate',
        'documentNumber',
        'names',

        'igv',
        'state',

        'idVoucherType',
        'idSale'
    ];

    public function voucherType()
    {
        return $this->belongsTo('App\VoucherType', 'idVoucherType', 'idVoucherType');
    }
    public function sale()
    {
        return $this->belongsTo('App\Sale', 'idSale', 'idSale');
    }
}
