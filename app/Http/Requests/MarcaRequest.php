<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MarcaRequest extends FormRequest
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
                'marca'=>'required|min:2|max:20|unique:marcas,marca,'.$this->route('marca').',idmarca'
            ];
        }else{
            return [
                'marca'=>'required|min:2|max:20|regex:/^[a-z A-Z áéíóúñ ÁÉÍÓÚÑ]+$/u|unique:marcas,marca'
            ];
        }

    }
}
