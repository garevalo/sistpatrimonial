<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OficinaRequest extends FormRequest
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
                'oficina'=>'required|min:1|max:20',
                'idlocal'    =>'required|integer',
            ];
        } else {
            return [
                'oficina'=>'required|min:1|max:20',
                'idlocal'    =>'required|integer',
            ];
        }
    }
}
