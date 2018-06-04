<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonalRequest extends FormRequest
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
        $validation = array(
            'nombres' =>'required|regex:/^[a-z A-Z áéíóúñ ÁÉÍÓÚÑ]+$/u',
            'apellido_paterno' => 'required|regex:/^[a-z A-Z áéíóúñ ÁÉÍÓÚÑ]+$/u',
            'apellido_materno' => 'required|regex:/^[a-z A-Z áéíóúñ ÁÉÍÓÚÑ]+$/u',
            'idcargo_personal' => 'required|integer',
            //'idgerencia_personal' => 'required|integer',
            //'idsubgerencia_personal' => 'integer'
        );

        if($this->request->has('_method')){

            $validation['dni'] = 'required|numeric|digits:8|unique:personals,dni,'.$this->route('personal').',idpersonal';
        }else{
            $validation['dni'] ='required|numeric|digits:8|unique:personals,dni';
        }

        return $validation;
    }



    public function messages()
    {
        return [
            'idcargo_personal.required' => 'Campo Cargo es requerido',
            'idcargo_personal.integer' => 'Campo Cargo debe ser entero',
            'idsubgerencia_personal.required' => 'Campo Subgerencia es requerido',
            'idsubgerencia_personal.integer' => 'Campo Subgerencia debe ser entero',
        ];
    }
}
