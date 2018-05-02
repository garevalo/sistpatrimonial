<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GrupoGenericoRequest extends FormRequest
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
                'cod_grupo_generico'=>'required|min:1|unique:grupo_genericos,cod_grupo_generico,'.$this->route('grupogenerico').',idgrupogenerico',
                'grupo_generico'    =>'required|regex:/^[a-z A-Z áéíóúñ ÁÉÍÓÚÑ]+$/u|min:2|unique:grupo_genericos,cod_grupo_generico,'.$this->route('grupogenerico').',idgrupogenerico',
            ];
        } else {
            return [
                'cod_grupo_generico'=>'required|min:1|unique:grupo_genericos,cod_grupo_generico',
                'grupo_generico'    =>'required|min:2|unique:grupo_genericos,grupo_generico',
            ];
        }
        
    }


    public function messages()
    {
        return [
            'cod_grupo_generico.unique' => 'Codigo ya existe',
        ];
    }
}
