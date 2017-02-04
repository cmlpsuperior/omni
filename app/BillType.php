<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillType extends Model
{
    protected $table='billType';

    protected $primaryKey = 'idBillType';

    public $timestamps=false;

    protected $fillable = [
    	'name',
    	'description',
        'state',
        'isSale'
    ];


    //relaciones con otros modelos:
    public function bills()
    {
        return $this->hasMany('App\Bill', 'idBillType', 'idBillType');
    }
}
