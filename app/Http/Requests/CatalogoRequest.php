<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CatalogoRequest extends FormRequest
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

            $validation = array(
                'codcatalogo' => 'required|size:8|unique:catalogos,codcatalogo,'.$this->route('catalogo').',codcatalogo',
                'denom_catalogo' => 'required|min:2|max:60|unique:catalogos,denom_catalogo,'.$this->route('catalogo').',denom_catalogo',
                'idestado' => 'required|integer',
                'cod_grupo_generico' => 'required',
                'cod_clase_generico' => 'required'
            );
        }else{
            $validation = array(
                'codcatalogo' => 'required|size:8|unique:catalogos,codcatalogo',
                'denom_catalogo' => 'required|min:2|max:60|unique:catalogos,denom_catalogo',
                'idestado' => 'required|integer',
                'cod_grupo_generico' => 'required',
                'cod_clase_generico' => 'required'
            );
        }

        return $validation;
    }
}
