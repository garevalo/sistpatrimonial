<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ColorRequest extends FormRequest
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
                'color'=>'required|min:2|regex:/^[a-z A-Z áéíóúñ ÁÉÍÓÚÑ]+$/u|unique:colors,color,'.$this->route('color').',idcolor'
            ];
        }else{
            return [
                'color'=>'required|min:2|regex:/^[a-z A-Z áéíóúñ ÁÉÍÓÚÑ]+$/u|unique:colors,color'
            ];
        }

    }
}
