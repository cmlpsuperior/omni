<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table='client';

    protected $primaryKey = 'idClient';

    public $timestamps=false;

    protected $fillable = [
    	'names',
    	'fatherLastName',
    	'motherLastName',

    	'birthdate',
    	'documentNumber',
        'email',
        
        'gender',        
        'phone',        
        'registerDate',

    	'idDocumentType'
    ];


    //relaciones con otros modelos:
    public function documentType()
    {
        return $this->belongsTo('App\DocumentType', 'idDocumentType', 'idDocumentType');
    }

    public function addresses()
    {
        return $this->hasMany('App\Address', 'idClient', 'idClient');
    }
    
}
