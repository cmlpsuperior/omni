<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table='unit';

    protected $primaryKey = 'idUnit';

    public $timestamps=false;

    protected $fillable = [
    	'name'
    ];


    //relaciones con otros modelos:
    public function item()
    {
        return $this->hasMany('App\Item', 'idItem', 'idItem');
    }
}