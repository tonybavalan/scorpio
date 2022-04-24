<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTripRequest extends FormRequest
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
            'customer_id' => 'required|integer',
            'pickup' => 'required|string',
            'drop' => 'required|string',
        ];
    }

    /**
     * Get the bodyParameters that apply to the request.
     * 
     * @return array
     */
    public function bodyParameters()
    {
        return [
            'customer_id' =>[
                'description' => 'id of the customer for whom the booking has to be created',
            ],
            'pickup' => [
                'description' => 'Pickup address with state & country of the customer',
                'example' => 'Chennai, India'
            ],
            'drop' => [
                'description' => 'Drop address with state & country of the customer',
                'example' => 'Madurai, TamilNadu, India'
            ],
        ];
    }
}