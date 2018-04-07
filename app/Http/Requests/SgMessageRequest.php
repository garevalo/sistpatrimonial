<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SgMessageRequest extends FormRequest
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


        if($this->request->has('_method')){
            return [
                'subgerencia'=>'required|min:5|regex:/^[a-z A-Z áéíóúñ ÁÉÍÓÚÑ]+$/u|unique:subgerencias,subgerencia,'.$this->route('subgerencia').',idsubgerencia'
            ];
        }else{
            return [
                'subgerencia' => 'required|regex:/^[a-z A-Z áéíóúñ ÁÉÍÓÚÑ]+$/u|unique:subgerencias,subgerencia'
            ];
        }
    }

    public function messages()
    {
        return [
            'idgerencia.required' => 'Campo Gerencia es requerido',
            'idgerencia.integer' => 'Campo Gerencia debe ser entero',
        ];
    }
}
