<?php

namespace App\Http\Controllers\Account;

use App\Rules\CurrentPassword;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ActionController extends Controller
{
    /**
     * Logout current user from all other devices
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logoutOtherDevices(Request $request)
    {
        $this->validate($request, [
            'current_password' => ['required', 'string', new CurrentPassword()],
        ]);

        Auth::logoutOtherDevices($request->input('current_password'));

        alert()->success('You have been logged out from other devices.');
        return back();
    }
}
