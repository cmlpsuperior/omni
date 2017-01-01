<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Order extends Model
{
    protected $table='order';

    protected $primaryKey = 'idOrder';

    public $timestamps=false;

    protected $fillable = [
    	'name',
    	'address',
        'phone',

    	'registerDate',
        'totalAmount',
        'receivedAmount',
        
    	'state',

    	'idClient',
    	'idZone',
    	'idEmployee'
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

    public function items (){
        return $this->belongsToMany('App\Item', 'itemXOrder', 'idOrder', 'idItem')
                    ->withPivot('quantity', 'unitPrice');
    }
}
