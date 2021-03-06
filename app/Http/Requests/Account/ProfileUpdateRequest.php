<?php

namespace App\Http\Requests\Account;

use App\Rules\PersonNameRule;
use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
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
            'primary_phone' => 'nullable|string|digits_between:10,20',
        ];
    }
}
