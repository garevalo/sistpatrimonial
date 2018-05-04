<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClaseGenericoRequest extends FormRequest
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
                'cod_clase_generico'=>'required|min:1',
                'clase_generico'    =>'required|regex:/^[a-z A-Z áéíóúñ ÁÉÍÓÚÑ]+$/u|min:2',
                'cod_grupo_generico'    =>'required',
            ];
        } else {
            return [
                'cod_clase_generico'=>'required|min:1',
                'clase_generico'    =>'required|regex:/^[a-z A-Z áéíóúñ ÁÉÍÓÚÑ]+$/u|min:2',
                'cod_grupo_generico'    =>'required',
            ];
        }
    }
}
