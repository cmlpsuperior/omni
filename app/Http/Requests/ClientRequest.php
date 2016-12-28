<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
            'documentNumber' => 'required|numeric|digits_between:8,20|unique:client,documentNumber',
            'email' => 'email|unique:client,email|max:100',

            'gender' => 'required',
            'phone' => 'numeric',            

            'idDocumentType' => 'required|numeric'
        ];
    }

    public function messages (){
        return [
            'documentNumber.unique' => 'Ya existe un cliente con ese número de documento.',
            'email.unique' => 'El correo ya le pertenece a otro cliente.'
        ];
    }
}
