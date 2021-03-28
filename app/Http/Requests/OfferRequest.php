<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
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
            'wage' => ['bail', 'required', 'between:0,49.99',],
            'comment' => ['bail', 'required', 'string', 'max:1000',],
            'start' => ['bail', 'required', 'date'],
            'end' => ['bail', 'required', 'date', 'after:start'],
            'seat' => ['bail', 'required', 'integer', 'between:1,50',],
            'company_id' => ['bail', 'min:1',],
            'locality_id' => ['bail', 'min:1',],
        ];
    }
}