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
            'name' => 'required|string|max:255',
            'location' => 'required|string',
            'password' => 'required|string|confirmed',
        ];

        if($this->is('driver/create'))
        {
            $rules[] =  Driver::VALIDATION_RULES;
        }

        if($this->is('customer/create'))
        {
            $rules[] =  Customer::VALIDATION_RULES;
        }

        return $rules;
    }
}
