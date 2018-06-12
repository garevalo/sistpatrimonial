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
        return [
            'codcatalogo'    => 'required|max:8',
            'codinventario' => 'required|max:12',
            'codpatrimonial' => 'required|max:12',
            'ordencompra' => 'required',
            'idmarca' => 'required|integer',
            'idmodelo' => 'required|integer',
            'idcolor' => 'required|integer',
            'imagen' => 'required|mimes:jpeg,png,jpg|max:2048',
            'numserie' => 'required',
            'centrocosto' => 'required',
            'idpersonal' => 'required|integer',
            'idestado' => 'required|integer',
            'valor' => 'required',
            'idadquisicion' => 'required|integer',
            'idproveedor'   => 'required|integer',
            'idlocal'       => 'required|integer',
            'idoficina'     => 'required|integer',
            'fecha_adquisicion' => 'required|date_format:d/m/Y',
            'descripcion' => 'required|max:250',
        ];
    }
}
