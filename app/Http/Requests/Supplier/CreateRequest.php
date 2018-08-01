<?php

namespace App\Http\Requests\Supplier;

use App\Models\Supplier;
use App\Rules\PersonNameRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'first_name' => ['required', 'string', 'min:3', 'max:100', new PersonNameRule()],
            'last_name' => ['nullable', 'string', 'min:1', 'max:100', new PersonNameRule()],
            'email' => 'bail|required|string|email|max:255|unique:' . with(new Supplier())->getTable() . ',email',
            'address' => 'nullable|string|min:3|max:500',
            'primary_phone' => 'required|string|digits_between:10,20',
            'alternate_phone' => 'nullable|string|digits_between:10,20',
            'active' => 'nullable'
        ];
    }
}
