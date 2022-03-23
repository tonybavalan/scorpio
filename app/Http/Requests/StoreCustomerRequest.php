<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
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
            'email' => 'required|email|min:6|unique:customers,email',
            'phone_no' => 'required|string|unique:customers,phone_no',
            'location' => 'required|string',
            'password' => 'required|string|confirmed',
        ];
    }

    public function bodyParameters()
    {
        return [
            'name' => [
                'description' => 'The name of the customer',
            ],
            'email' => [
                'description' => 'The email of the customer',
            ],
            'phone_no' => [
                'description' => 'The phone_no of the customer',
            ],
            'password' => [
                'description' => 'The password of the customer',
            ],
        ];
    }
}
