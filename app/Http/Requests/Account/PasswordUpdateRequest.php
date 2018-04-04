<?php

namespace App\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CurrentPassword;

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
        if ($this->allowWithoutOldPassword()) {
            return [
                'password' => 'bail|required|string|min:6|confirmed'
            ];
        }

        return [
            'current_password' => ['required', 'string', new CurrentPassword()],
            'password' => 'bail|required|string|min:6|different:current_password|confirmed'
        ];
    }

    /**
     * Allow user to change password without knowing his current
     *
     * @return bool
     */
    protected function allowWithoutOldPassword()
    {
        return
            // User logged in via social
            $this->session()->has('auth.social_id') &&
            // User does not have a password yet
            $this->user()->has_null_password;
    }
}
