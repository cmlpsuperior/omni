<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table='Employee';

    protected $primaryKey = 'idEmployee';

    public $timestamps=false;

    protected $fillable = [
    	'names',
    	'fatherLastName',
    	'motherLastName',
    	'birthdate',
    	'documentNumber',
        'email',
        'state',
        'gender',        
        'phone',
        
        'entryDate',
        'endDate',
        
        'idPosition',        
    	'idDocumentType',
    	'idDriverLicense',
    	'idUser'
    ];


    //relaciones con otros modelos:
    public function user()
    {
        return $this->belongsTo('App\User', 'idUser', 'id');
    }

    public function documentType()
    {
        return $this->belongsTo('App\DocumentType', 'idDocumentType', 'idDocumentType');
    }
    
    public function driverLicense (){
    	return $this->belongsTo('App\DriverLicense', 'idDriverLicense', 'idDriverLicense');
    }
}
