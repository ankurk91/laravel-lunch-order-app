<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  mixed $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        // If user account found disabled
        if ($user->is_blocked) {
            // Logout immediately
            $this->forceLogout($request);

            alert()->error('Your account is disabled. Please contact administrator for assistance.');
            return back()->withInput($request->only($this->username()));
        }
    }

    /**
     * Logout from active session
     *
     * @param Request $request
     */
    protected function forceLogout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();
    }
}
