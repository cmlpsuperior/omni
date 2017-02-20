<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VoucherType extends Model
{
    protected $table='voucherType';

    protected $primaryKey = 'idVoucherType';

    public $timestamps=false;

    protected $fillable = [
        'name',
        'forSale'
    ];
}
