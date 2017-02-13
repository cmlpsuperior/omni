<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table='unit';

    protected $primaryKey = 'idUnit';

    public $timestamps=false;

    protected $fillable = [
    	'name',
        'legalCode'
    ];


    //relaciones con otros modelos:
    public function items()
    {
        return $this->hasMany('App\Item', 'idItem', 'idItem');
    }
}
