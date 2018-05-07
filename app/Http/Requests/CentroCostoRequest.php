<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CentroCostoRequest extends FormRequest
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
                'idlocal'       => 'required|min:1',
                'idpersonal'    => 'required|min:1',
                'codcentrocosto'    => 'required|min:1|unique:centro_costos,codcentrocosto,'.$this->route('centrocosto').',id',
                'centrocosto'    => 'required|min:1|unique:centro_costos,centrocosto,'.$this->route('centrocosto').',id',
            ];
        } else {
            return [
                'idlocal'           => 'required|min:1',
                'idpersonal'        => 'required|min:1',
                'codcentrocosto'    => 'required|min:1|unique:centro_costos,codcentrocosto',
                'centrocosto'       => 'required|min:1|unique:centro_costos,centrocosto',
            ];
        }
    }
}
