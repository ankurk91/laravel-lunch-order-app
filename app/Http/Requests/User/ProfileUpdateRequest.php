<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\PersonName;

class ProfileUpdateRequest extends FormRequest
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
            'first_name' => ['required', 'string', 'min:3', 'max:100', new PersonName()],
            'last_name' => ['nullable', 'string', 'min:1', 'max:100', new PersonName()],
            'primary_phone' => 'nullable|string|digits_between:10,20',
        ];
    }
}
