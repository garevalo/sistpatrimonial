<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BajaRequest extends FormRequest
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
                'imagen' => 'required|mimes:jpeg,png,jpg|max:2048',
                'idpersonal' => 'required|integer',
                'centrocosto' => 'required|max:5',
                'idlocal'       => 'required|integer',
                'idoficina'     => 'required|integer',
                'fechabaja' => 'required|date_format:d/m/Y',
                'descripcion' => 'required|max:250',
                'causalbaja'  => 'required',
        ];
    }
}
