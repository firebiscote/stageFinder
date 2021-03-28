<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
            'name' => ['bail', 'required', 'string', 'max:50',],
            'email' => ['bail', 'required', 'email', 'max:50',],
            'line' => ['bail', 'required', 'string', 'max:30',],
            'trainee' => ['bail', 'required', 'integer', 'between:0,30000',],
            'confidence' => ['bail', 'nullable', 'integer', 'between:1,10',],
        ];
    }
}