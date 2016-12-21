<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    protected $table='zone';

    protected $primaryKey = 'idZone';

    public $timestamps=false;

    protected $fillable = [
    	'name',
    	'shipping',
        'state'
    ];


    //relaciones con otros modelos:
    public function items (){
        return $this->belongsToMany('App\Item', 'itemXZone', 'idZone', 'idItem')
                    ->withPivot('price','shipping');
    }
}
