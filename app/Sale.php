<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table='sale';

    protected $primaryKey = 'idSale';

    public $timestamps=false;

    protected $fillable = [
        'registerDate',
        'discount',
        'freight',

        'totalAmount',
        'state',        
        'observations',    
        
    	'idClient',
    	'idZone',
    	'idEmployee',
        'idMoneyType'
    ];

    

    //relaciones con otros modelos:
    public function client()
    {
        return $this->belongsTo('App\Client', 'idClient', 'idClient');
    }
    public function zone()
    {
        return $this->belongsTo('App\Zone', 'idZone', 'idZone');
    }
    public function employee()
    {
        return $this->belongsTo('App\Employee', 'idEmployee', 'idEmployee');
    }
    public function items (){
        return $this->belongsToMany('App\Item', 'itemXSale', 'idSale', 'idItem')
                    ->withPivot('orderNumber', 'quantity', 'unitPrice')->orderBy('orderNumber','asc');
    }
    public function moneyType (){
        return $this->belongsTo('App\MoneyType', 'idMoneyType', 'idMoneyType');
    }

    //relaciones con otros modelos:
    public function salePayments()
    {
        return $this->hasMany('App\SalePayment', 'idSale', 'idSale');
    }


    //mutators:
    public function getFinalAmountAttribute(){
        return $this->totalAmount + $this->freight - $this->discount;
    }

    public function getTotalPaymentAttribute(){
        $sum=0;
        foreach( $this->salePayments as $salePayment){
            $sum = $sum + $salePayment->amountPaid; //mutator too
        }

        return $sum;
    }
}
