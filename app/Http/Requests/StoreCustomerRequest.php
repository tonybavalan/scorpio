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
            'customername' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'phone_no' => 'required|string|unique:customers,phone_no',
            'location' => 'required|string',
            'password' => 'required|string|confirmed',
        ];
    }
}
