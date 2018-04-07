<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HardwareRequest extends FormRequest
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
            'marca'     => 'required',
            'modelo'    => 'required',
            'num_serie' => 'required',
            'fecha_adquisicion' => 'required|date_format:d/m/Y',
            //'orden_compra'  => 'required',
            'estado'    => 'required|integer',
            'estado_activo'    => 'required|integer',
            'idtipo_hardware' => 'required|integer'
        ];
    }
}
