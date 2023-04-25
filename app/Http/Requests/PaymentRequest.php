<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
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
            'value' => 'required',
            'customer_id' => 'required',
            'billingType' => 'required'
        ];
    }

    public function messages()
    {
        return [
          'value.required' => 'sem valor definido',
          'customer_id.required' => 'sem código de cliente definido',
          'billingType.required' => 'sem tipo de cobrança definido'
        ];
    }
}
