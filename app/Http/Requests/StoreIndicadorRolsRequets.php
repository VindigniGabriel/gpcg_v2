<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreIndicadorRolsRequets extends FormRequest
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
            'indicador_id' => 'required',
            'min' => 'required',
            'med' => 'required',
            'max' => 'required',
            'indicador_tipo_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'indicador_tipo_id.required' => 'El campo Tipo Indicador de Ingreso es obligatorio'
        ];
    }
}
