<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table='item';

    protected $primaryKey = 'idItem';

    public $timestamps=false;

    protected $fillable = [
    	'name',
    	'price',
    	'state',

    	'idUnit'
    ];


    //relaciones con otros modelos:
    public function unit()
    {
        return $this->belongsTo('App\Unit', 'idUnit', 'idUnit');
    }

    public function zones (){
        return $this->belongsToMany('App\Zone', 'itemXZone', 'idItem', 'idZone')
                    ->withPivot('price');
    }
}
