<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProForma extends Model
{
    protected $table='proForma';

    protected $primaryKey = 'idProForma';

    public $timestamps=false;

    protected $fillable = [
        'registerDate',
        'discount',
        'freight',

        'totalAmount',   
        
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
        return $this->belongsToMany('App\Item', 'itemXProForma', 'idProForma', 'idItem')
                    ->withPivot('orderNumber', 'quantity', 'unitPrice')->orderBy('orderNumber','asc');
    }
    public function moneyType (){
        return $this->belongsTo('App\MoneyType', 'idMoneyType', 'idMoneyType');
    }


    //mutators:
    public function getFinalAmountAttribute(){
        return $this->totalAmount + $this->freight - $this->discount;
    }

}
