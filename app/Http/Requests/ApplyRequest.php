<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplyRequest extends FormRequest
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
            'company_id' => ['bail', 'required', 'integer', 'min:1'],
            'message' => ['bail', 'string'],
            'name' => ['bail', 'required', 'string', 'max:30',],
            'CV' => ['bail', 'required',],
            'motivationLetter' => ['bail', 'required',],
        ];
    }
}