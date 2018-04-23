<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GerenciaRequest extends FormRequest
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
     * @return arrays
     */
    public function rules()
    {

        if($this->request->has('_method')){
            return [
                'gerencia'=>'required|min:5|regex:/^[a-z A-Z áéíóúñ ÁÉÍÓÚÑ]+$/u|unique:gerencias,gerencia,'.$this->route('gerencia').',idgerencia',
                'centrocosto'=>'required|min:2|unique:centro_costos,codcentrocosto'
            ];
        }else{
            return [
                'gerencia' => 'required|regex:/^[a-z A-Z áéíóúñ ÁÉÍÓÚÑ]+$/u|unique:gerencias,gerencia',
                'centrocosto'=>'required|min:2|unique:centro_costos,codcentrocosto',
            ];
        }
    }

     public function messages()
    {
        return [
            'centrocosto.unique' => 'Centro de costo ya existe',
        ];
    }
}
