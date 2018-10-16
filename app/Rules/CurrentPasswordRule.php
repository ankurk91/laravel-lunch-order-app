<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class CurrentPasswordRule implements Rule
{

    /**
     * @var string
     */
    private $guard;

    /**
     * Create a new rule instance.
     *
     * @param string $guard
     */
    public function __construct($guard = 'web')
    {
        $this->guard = $guard;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return Hash::check($value, Auth::guard($this->guard)->user()->getAuthPassword());
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute field does not match with your stored password.';
    }
}
