<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    protected $table='documentType';

    protected $primaryKey = 'idDocumentType';

    public $timestamps=false;

    protected $fillable = [
    	'name',
    	'description'
    ];


    //relaciones con otros modelos:
    public function employees()
    {
        return $this->hasMany('App\Employee', 'idDocumentType', 'idDocumentType');
    }
}
