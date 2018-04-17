<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{

    public $rules = [
        'name' => 'required|min:3|max:255',
        'description' => 'nullable|min:3|max:255',
        'max_quantity' => 'required|numeric|min:1|max:9999',
        'unit_price' => 'required|numeric|min:1|max:9999',
        'active' => 'nullable'
    ];

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
        return $this->rules;
    }
}
