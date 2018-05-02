<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProveedorRequest extends FormRequest
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
                'razon_social'=>'required|min:1|unique:proveedors,razon_social,'.$this->route('proveedor').',idproveedor',
                'ruc'    =>'required|max:11|unique:proveedors,ruc,'.$this->route('proveedor').',idproveedor',
                'telefono'    =>'required|max:9|unique:proveedors,telefono,'.$this->route('proveedor').',idproveedor',
                'direccion'    =>'required',
            ];
        } else {
            return [
                'razon_social'=>'required|min:1|unique:proveedors,razon_social',
                'ruc'    =>'required|max:11|unique:proveedors,ruc',
                'telefono'    =>'required|max:9|unique:proveedors,telefono',
                'direccion'    =>'required',
            ];
        }
    }
}
