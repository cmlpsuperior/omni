<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    protected $table='bankAccount';

    protected $primaryKey = 'idBankAccount';

    public $timestamps=false;

    protected $fillable = [
        'bankName',
        'accountNumber',
        'interbankAccountNumber',
        'bankAccount'
    ];
}
