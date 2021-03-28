<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
            'name' => ['bail', 'required', 'string', 'max:30',],
            'firstName' => ['bail', 'required', 'string', 'max:30',],
            'email' => ['bail', 'required', 'email', 'unique:users', 'max:50',],
            'role' => ['bail', 'char', Rule::in(['A', 'T', 'S', 'D']),],
            'password' => ['bail', 'required', 'min:8',],
            'confirmPassword' => ['bail', 'required', 'same:password',],
            'center_id' => ['bail', 'min:1',],
            'right_id' => ['bail', 'min:1',],
        ];
    }
}