<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientUpdateRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }
   
    public function rules()
    {
        return [
            'names' => 'required|regex:/^[\pL\s\-]+$/u|max:100',
            'fatherLastName' => 'required|regex:/^[\pL\s\-]+$/u|max:100',
            'motherLastName' => 'required|regex:/^[\pL\s\-]+$/u|max:100',

            'birthdate' => 'date',
            //'documentNumber' => 'required|numeric|digits_between:8,20|unique:client,documentNumber',
            'email' => 'email|max:100',

            'gender' => 'required',
            'phone' => 'numeric',            

            //'idDocumentType' => 'required|numeric'
        ];
    }
}
