<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RatingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'grade' => ['bail', 'required', 'integer', 'between:1,10',],
            'comment' => ['bail', 'required', 'string', 'max:1000',],
            'company_id' => ['bail', 'min:1',],
            'user_id' => ['bail', 'min:1',],
        ];
    }
}