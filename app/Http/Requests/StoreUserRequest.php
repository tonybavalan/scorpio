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
        $rules = [
            'name' => 'required|string',
            'location' => 'required|string',
            'password' => 'required|string|confirmed',
        ];

        if($this->is('driver/create'))
        {
            $rules[] =  [
                'drivername' => [
                    'required',
                    'string',
                    'max:255'
                ],
                'email' => [
                    'required',
                    'email',
                    'unique:drivers,email'
                ],
                'phone_no' => [
                    'required',
                    'string',
                    'unique:drivers,phone_no'
                ]
            ];
        }

        if($this->is('customer/create'))
        {
            $rules[] =  [
                'customername' => [
                    'required',
                    'string',
                    'max:255'
                ],
                'email' => [
                    'required',
                    'email',
                    'unique:customers,email'
                ],
                'phone_no' => [
                    'required',
                    'string',
                    'unique:customers,phone_no'
                ]
            ];
        }

        return $rules;
    }
}
