<?php

namespace App\Http\Requests\Account;

use App\Rules\MatchCurrentPasswordRule;
use Illuminate\Foundation\Http\FormRequest;

class PasswordUpdateRequest extends FormRequest
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
            'current_password' => ['required', 'string', new MatchCurrentPasswordRule()],
            'password' => 'bail|required|string|min:8|different:current_password|confirmed',
        ];
    }

}
