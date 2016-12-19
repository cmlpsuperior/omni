<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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

            'birthdate' => 'required|date',
            'documentNumber' => 'required|numeric|digits_between:8,20|unique:employee,documentNumber',
            'email' => 'email|unique:employee,email|max:100',

            //'state', 
            'gender' => 'required',
            'phone' => 'numeric',

            'entryDate' => 'required|date',
            //'endDate',

            'idDocumentType' => 'required|numeric',
            'idDriverLicense' => 'numeric|numeric',
            'idPosition' => 'required|numeric'


        ];
    }

    public function messages (){
        return [
            'documentNumber.unique' => 'Ya existe un usuario con ese número de documento.',
            'email.unique' => 'El correo ya le pertenece a otro usuario.'
        ];
    }
}
