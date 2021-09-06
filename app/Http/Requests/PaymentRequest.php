<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
{
    

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'payment_number' => 'required',
            'payment_amount' => 'required',
        ];

    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'payment_number.required' => 'Payment number is required',
            'payment_amount.required' => 'Payment amount is required',
        ];
    }

    /**
 * Get custom attributes for validator errors.
 *
 * @return array
 */
public function attributes()
{
    return [
        'payment_number' => 'Payment Number',
        'payment_amount' => 'Payment Amount'
    ];
}
}
