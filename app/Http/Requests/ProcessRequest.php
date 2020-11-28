<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProcessRequest extends FormRequest
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
            'box' => "required",
        ];
    }

    public function messages()
    {
        return [
            "box.required" => "A caixa de atendimento deve ser escolhida para continuar o processo.",
        ];
    }
}
