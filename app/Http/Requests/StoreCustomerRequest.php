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
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:customers,email',
            'phone_no' => 'required|regex:/(01)[0-9]{9}/|unique:customers,phone_no',
            'location' => 'required|string',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => '',
        ];
    }

    public function bodyParameters()
    {
        return [
            'name' => [
                'description' => 'Name of the customer',
            ],
            'email' => [
                'description' => 'Email of the customer',
            ],
            'phone_no' => [
                'description' => 'Phone number of the customer with country code',
            ],
            'location' => [
                'description' => 'Current city with state & country of the customer',
                'example' => 'Chennai, TamilNadu, India'
            ],
            'password' => [
                'description' => 'Password for the customer',
                'example' => 'secret'
            ],
            'password_confirmation' => [
                'description' => 'Repeat password for the customer',
            ],
        ];
    }
}
