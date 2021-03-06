<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemsBillRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    
    public function rules()
    {
        return [
            'idItems' => 'required'
        ];
    }

    public function messages (){
        return [            
            'idItems.required' => 'Debe ingresar al menos un material a la lista.'
        ];
    }
}
