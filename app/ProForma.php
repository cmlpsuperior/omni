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
        'totalAmount',

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

    public function items(){
        return $this->belongsToMany('App\Item', 'itemXProForma', 'idProForma', 'idItem')
                    ->withPivot('quantity', 'unitPrice');
    }
}
