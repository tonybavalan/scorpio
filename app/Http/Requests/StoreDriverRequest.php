<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDriverRequest extends FormRequest
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
            'email' => 'required|email|unique:drivers,email',
            'phone_no' => 'required|string|unique:drivers,phone_no',
            'location' => 'required|string',
            'password' => 'required|string|min:6|confirmed',
        ];
    }

    public function bodyParameters()
    {
        return [
            'name' => [
                'description' => 'The name of the driver',
            ],
            'email' => [
                'description' => 'The email of the driver',
            ],
            'phone_no' => [
                'description' => 'The phone_no of the driver',
            ],
            'password' => [
                'description' => 'The password of the driver',
            ],
        ];
    }
}
