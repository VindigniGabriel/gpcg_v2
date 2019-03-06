<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGerenciaRequest extends FormRequest
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
            'alias' => 'required',
            'titular' => 'required',
            'phone' => 'required|min:12',
            'email' => 'email',
            'direccion_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'direccion_id.required' => 'El campo Dirección Comercial es obligatorio'
        ];
    }
}
