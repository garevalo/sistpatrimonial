<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModeloRequest extends FormRequest
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
                'modelo'=>'required|min:5|regex:/^[a-z A-Z áéíóúñ ÁÉÍÓÚÑ]+$/u|unique:modelos,modelo,'.$this->route('modelo').',idmodelo'
            ];
        }else{
            return [
                'modelo'=>'required|min:5|regex:/^[a-z A-Z áéíóúñ ÁÉÍÓÚÑ]+$/u|unique:modelos,modelo'
            ];
        }
    }
}
