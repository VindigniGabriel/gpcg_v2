<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRxpRequest extends FormRequest
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
            'name' => 'string|max:10',
            'goal_id' => 'required|max:12'
        ];
    }

    public function messages()
    {
        return [
            'goal_id.required' => 'Error. Debe asociar un Logro al Ajuste Personalizado.',
        ];
    }
}
