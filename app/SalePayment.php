<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalePayment extends Model
{
    protected $table='salePayment';

    protected $primaryKey = 'idSalePayment';

    public $timestamps=false;

    protected $fillable = [
        'debtAmount',
        'receivedAmount',
        'registerDate',

        'idSale',
        'idEmployee',        
        'idPaymentType',
        'idBankAccount'
    ];


    //relaciones con otros modelos:
    public function sale()
    {
        return $this->belongsTo('App\Sale', 'idSale', 'idSale');
    }
    public function employee()
    {
        return $this->belongsTo('App\Employee', 'idEmployee', 'idEmployee');
    }
    public function paymentType()
    {
        return $this->belongsTo('App\PaymentType', 'idPaymentType', 'idPaymentType');
    }
    public function bankAccount()
    {
        return $this->belongsTo('App\BankAccount', 'idBankAccount', 'idBankAccount');
    }

    
    //mutators:
    public function getAmountPaidAttribute(){
        if ($this->debtAmount >= $this->receivedAmount)
            return $this->receivedAmount;
        else
            return $this->debtAmount;
    }
}
