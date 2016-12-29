<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table='address';

    protected $primaryKey = 'idAddress';

    public $timestamps=false;

    protected $fillable = [
    	'address',
    	'reference',
    	'registerDate',
    	'latitude',
    	'longitude',

    	'idClient',
    	'idZone'
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

}
