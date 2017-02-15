<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    protected $table='paymentType';

    protected $primaryKey = 'idPaymentType';

    public $timestamps=false;

    protected $fillable = [
        'name',
        'description',
        'state'
    ];
}
