<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RightRequest extends FormRequest
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
            'SFx1' => ['bail', 'required', 'boolean'],
            'SFx2' => ['bail', 'required', 'boolean'],
            'SFx3' => ['bail', 'required', 'boolean'],
            'SFx4' => ['bail', 'required', 'boolean'],
            'SFx5' => ['bail', 'required', 'boolean'],
            'SFx6' => ['bail', 'required', 'boolean'],
            'SFx7' => ['bail', 'required', 'boolean'],
            'SFx8' => ['bail', 'required', 'boolean'],
            'SFx9' => ['bail', 'required', 'boolean'],
            'SFx10' => ['bail', 'required', 'boolean'],
            'SFx11' => ['bail', 'required', 'boolean'],
            'SFx12' => ['bail', 'required', 'boolean'],
            'SFx13' => ['bail', 'required', 'boolean'],
            'SFx14' => ['bail', 'required', 'boolean'],
            'SFx15' => ['bail', 'required', 'boolean'],
            'SFx16' => ['bail', 'required', 'boolean'],
            'SFx17' => ['bail', 'required', 'boolean'],
            'SFx18' => ['bail', 'required', 'boolean'],
            'SFx19' => ['bail', 'required', 'boolean'],
            'SFx20' => ['bail', 'required', 'boolean'],
            'SFx21' => ['bail', 'required', 'boolean'],
            'SFx22' => ['bail', 'required', 'boolean'],
            'SFx23' => ['bail', 'required', 'boolean'],
            'SFx24' => ['bail', 'required', 'boolean'],
            'SFx25' => ['bail', 'required', 'boolean'],
            'SFx26' => ['bail', 'required', 'boolean'],
            'SFx27' => ['bail', 'required', 'boolean'],
            'SFx28' => ['bail', 'required', 'boolean'],
            'SFx29' => ['bail', 'required', 'boolean'],
            'SFx30' => ['bail', 'required', 'boolean'],
            'SFx31' => ['bail', 'required', 'boolean'],
            'SFx32' => ['bail', 'required', 'boolean'],
            'SFx33' => ['bail', 'required', 'boolean'],
            'SFx34' => ['bail', 'required', 'boolean'],
            'SFx35' => ['bail', 'required', 'boolean'],
        ];
    }
}