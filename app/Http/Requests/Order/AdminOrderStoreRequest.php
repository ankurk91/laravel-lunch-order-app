<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AdminOrderStoreRequest extends FormRequest
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
        //todo more complex validation
        //todo 1. check if product ids exists in database and is_active
        //todo 2. max quantity
        return [
            'products' => 'bail|required|array',
            'staff_notes' => 'sometimes|nullable|string|max:255',
            'customer_notes' => 'sometimes|nullable|string|max:255',
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $this->validateAtLeastOneProduct($validator);
        });
    }

    private function validateAtLeastOneProduct($validator)
    {
        $products = array_filter($this->input('products', []));
        if (!$products) {
            $validator->errors()->add('products', 'You need to select at least one product.');
        }
    }

}
