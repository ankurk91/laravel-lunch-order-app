<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Rules\MatchCurrentPasswordRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class ActionController extends Controller
{

    /**
     * Logout current user from all other devices
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logoutOtherDevices(Request $request)
    {
        $this->validate($request, [
            'current_password' => ['required', 'string', new MatchCurrentPasswordRule()],
        ]);

        Auth::logoutOtherDevices($request->input('current_password'));

        alert()->success('You have been logged out from other devices.');
        return back();
    }


    /**
     * Send password reset email to user.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendPasswordResetEmail()
    {
        Password::sendResetLink([
            'email' => Auth::user()->getEmailForPasswordReset(),
        ]);

        alert()->success('Password reset email was sent successfully.');
        return back();
    }

}
