<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'phone_no' => 'required|string|unique:users,phone_no',
            'password' => 'required|string|min:6|confirmed',
        ];
    }

    public function bodyParameters()
    {
        return [
            'name' => [
                'description' => 'The name of the user',
            ],
            'email' => [
                'description' => 'The email of the user',
            ],
            'phone_no' => [
                'description' => 'The phone_no of the user',
            ],
            'password' => [
                'description' => 'The password of the user',
            ],
        ];
    }
}
