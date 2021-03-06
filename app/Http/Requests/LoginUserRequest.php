<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginUserRequest extends FormRequest
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
            'email' => 'required|email',
            'password' => 'required|string',
            'remember' => ''
        ];
    }

    public function bodyParameters()
    {
        return [
            'email' => [
                'description' => 'The email of the user',
            ],
            'password' => [
                'description' => 'The password of the user',
            ],
        ];
    }
}
