<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InstallRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "code" => 'required',
            "scope" => 'required',
            "context" => 'required',
        ];
    }

    public function messages()

    {

        return [

            'code.required' => 'Code is required',
            'scope.required' => 'Scope is required',
            'context.required' => 'Context is required'

        ];
    }
}
