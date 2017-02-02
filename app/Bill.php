<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $table='bill';

    protected $primaryKey = 'idBill';

    public $timestamps=false;

    protected $fillable = [
    	'name', //promforma , pedido, boleta *, factura * 
    	'shippingAddress',
        'phone', //promforma , pedido, boleta *, factura * 

        'documentNumber', // boleta *, factura *
        'legalAddress', // factura *
    	'registerDate',

        'totalAmount',
        'receivedAmount',        
    	'state',

        'observations',
        
    	'idClient',
    	'idZone',
    	'idEmployee',
    	'idBillType'
    ];


    //relaciones con otros modelos:
    public function zone()
    {
        return $this->belongsTo('App\Zone', 'idZone', 'idZone');
    }

    public function client()
    {
        return $this->belongsTo('App\Client', 'idClient', 'idClient');
    }

    public function employee()
    {
        return $this->belongsTo('App\Employee', 'idEmployee', 'idEmployee');
    }

    public function billType()
    {
        return $this->belongsTo('App\BillType', 'idBillType', 'idBillType');
    }


    public function items (){
        return $this->belongsToMany('App\Item', 'itemXBill', 'idBill', 'idItem')
                    ->withPivot('quantity', 'unitPrice');
    }
}
