<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocalRequest extends FormRequest
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
        return [
            'local'=>'required|min:1|unique:locals,local,'.$this->route('local').',idlocal'
        ];


        if($this->request->has('_method')){
            $validation = array('local'=>'required|min:1|unique:locals,local,'.$this->route('local').',idlocal');
        }else{
            $validation = array(
                'local'=>'required|min:1|unique:locals,local'
            );
        }

        return $validation;
    }
}
