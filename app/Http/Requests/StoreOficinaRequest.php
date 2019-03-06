<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOficinaRequest extends FormRequest
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
            'name' => 'required',
            'alias' => 'required|min:4|max:4',
            'ubicacion' => 'required|min:10',
            'oficina_tipo_id' => 'required',
            'direccion_id' => 'required',
            'gerencia_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'direccion_id.required' => 'El Dirección Comercial es obligatorio',
            'gerencia_id.required' => 'El Gerencia Comercial es obligatorio',
            'oficina_tipo_id.required' => 'Debe seleccionar el Tipo de Oficina',
        ];
    }
}
