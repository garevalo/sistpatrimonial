<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BienRequest extends FormRequest
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
                'codcatalogo'    => 'required|max:8',
                'codinventario' => 'required|max:12',
                'codpatrimonial' => 'required|max:12|unique:biens,codpatrimonial,'.$this->route('bien').',idbien',
                'ordencompra' => 'required',
                'idmarca' => 'required|integer',
                'idmodelo' => 'required|integer',
                'idcolor' => 'required|integer',
                'imagen' => 'mimes:jpeg,png,jpg|max:2048',
                'numserie' => 'required',
                'centrocosto' => 'required',
                'idpersonal' => 'required|integer',
                'valor' => 'required',
                'idadquisicion' => 'required|integer',
                'idproveedor'   => 'required|integer',
                'idlocal'       => 'required|integer',
                'idoficina'     => 'required|integer',
                'idestado'     => 'required|integer',
                'fecha_adquisicion' => 'required|date_format:d/m/Y',
                'descripcion' => 'required|max:250',
                'fecha_ordencompra' => 'required|date_format:d/m/Y'
            ];
        } else{

            return [
                'codcatalogo'    => 'required|max:8',
                'codinventario' => 'required|max:12',
                'codpatrimonial' => 'required|max:12|unique:biens,codpatrimonial',
                'ordencompra' => 'required',
                'idmarca' => 'required|integer',
                'idmodelo' => 'required|integer',
                'idcolor' => 'required|integer',
                'imagen' => 'required|mimes:jpeg,png,jpg|max:2048',
                'numserie' => 'required',
                'centrocosto' => 'required',
                'idpersonal' => 'required|integer',
                'valor' => 'required',
                'idadquisicion' => 'required|integer',
                'idproveedor'   => 'required|integer',
                'idlocal'       => 'required|integer',
                'idoficina'     => 'required|integer',
                'idestado'     => 'required|integer',
                'fecha_adquisicion' => 'required|date_format:d/m/Y',
                'descripcion' => 'required|max:250',
                'fecha_ordencompra' => 'required|date_format:d/m/Y'
            ];

        }

    }
}
