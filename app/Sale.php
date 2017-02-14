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
        'totalAmount',

        'payment',
        'state',        
        'observations',    
        
    	'idClient',
    	'idZone',
    	'idEmployee'
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
        return $this->belongsToMany('App\Item', 'itemXBill', 'idBill', 'idItem')
                    ->withPivot('quantity', 'unitPrice');
    }
}
