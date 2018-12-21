<?php

namespace App\Http\Requests\User;

use App\Models\User;
use App\Rules\PersonNameRule;
use Illuminate\Foundation\Http\FormRequest;
use Spatie\Permission\Models\Role;

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
            'email' => 'bail|required|string|email|max:255|unique:' . with(new User())->getTable() . ',email',
            'first_name' => ['required', 'string', 'min:3', 'max:100', new PersonNameRule()],
            'last_name' => ['nullable', 'string', 'min:1', 'max:100', new PersonNameRule()],
            'primary_phone' => 'nullable|string|digits_between:10,20',
            'roles' => 'bail|required|array|exists:' . with(new Role())->getTable() . ',id',
        ];
    }
}
