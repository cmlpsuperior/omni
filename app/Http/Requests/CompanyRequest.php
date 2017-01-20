<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'businessName' => 'required|max:100',

            'documentNumber' => 'required|numeric|digits_between:8,20|unique:client,documentNumber',
            'email' => 'email|unique:client,email|max:100',
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
