<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePersonalRequest extends FormRequest
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
            'date_in' => 'required',
            'date_rol_in' => 'required',
            'rol_id' => 'required',
            'email' => 'nullable|email'
        ];
       
    }
 
    public function messages()
    {
        return [
            'date_in.required' => 'El campo Fecha de Ingreso es obligatorio',
            'date_rol_in.required' => 'El campo Fecha Asignación Rol es obligatorio',
            'rol_id.required' => 'El campo Rol es obligatorio',
        ];
    }
}
