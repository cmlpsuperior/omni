<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DriverLicense extends Model
{
    protected $table='driverLicense';

    protected $primaryKey = 'idDriverLicense';

    public $timestamps=false;

    protected $fillable = [
    	'name',
    	'description'
    ];


    //relaciones con otros modelos:
    public function employee()
    {
        return $this->hasMany('App\Employee', 'idDriverLicense', 'idDriverLicense');
    }
}
