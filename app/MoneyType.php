<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MoneyType extends Model
{
    protected $table='moneyType';

    protected $primaryKey = 'idMoneyType';

    public $timestamps=false;

    protected $fillable = [
        'name'
    ];
}
