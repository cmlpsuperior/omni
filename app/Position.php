<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $table='position';

    protected $primaryKey = 'idPosition';

    public $timestamps=false;

    protected $fillable = [
    	'name',
    	'description'
    ];


    //relaciones con otros modelos:
    public function employee()
    {
        return $this->hasMany('App\Employee', 'idPosition', 'idPosition');
    }
}
