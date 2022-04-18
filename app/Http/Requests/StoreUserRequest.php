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
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email',
            'phone_no' => 'required|regex:/(01)[0-9]{9}/|unique:users,phone_no',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => '',
        ];
    }

    public function bodyParameters()
    {
        return [
            'name' => [
                'description' => 'Name of the user',
            ],
            'email' => [
                'description' => 'Email of the user',
            ],
            'phone_no' => [
                'description' => 'Phone number of the user',
            ],
            'password' => [
                'description' => 'Password for the user',
                'example' => 'secret'
            ],
            'password_confimation' => [
                'description' => 'Repeat password for the user',
            ],
        ];
    }
}
