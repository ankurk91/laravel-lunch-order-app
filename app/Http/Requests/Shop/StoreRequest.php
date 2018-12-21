<?php

namespace App\Http\Requests\Shop;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'products' => 'required|array',
            'products.*.id' => 'required|integer',
            'products.*.quantity' => 'nullable|numeric|min:1|max:9999',
            'customer_notes' => 'nullable|string|max:255',
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator $validator
     *
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            // Don't proceed with additional validation when there is already error messages
            if ($validator->errors()->isNotEmpty()) {
                return;
            }
            $products = collect($this->input('products', []));

            $selectedProducts = $products->filter(function ($product) {
                return array_get($product, 'quantity');
            })->unique('id');

            if ($selectedProducts->isEmpty()) {
                $validator->errors()->add('products', 'You need to select at least one product.');
            }

            $productsExists = Validator::make(
                [
                    'products' => $selectedProducts->pluck('id')->toArray(),
                ],
                [
                    'products' => [
                        'required',
                        Rule::exists(with(new Product())->getTable(), 'id')->where('active', 1),
                    ],
                ]);

            if ($productsExists->fails()) {
                $validator->errors()->add('products', 'One or more selected product no longer available for purchase.');
            }
        });
    }
}
