<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\PasswordUpdateRequest;
use Illuminate\Auth\Events\PasswordReset as PasswordResetEvent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PasswordController extends Controller
{

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('account.password', [
            'user' => Auth::user(),
        ]);
    }

    /**
     * Update the user password in storage.
     *
     * @param  PasswordUpdateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(PasswordUpdateRequest $request)
    {
        $user = Auth::user();
        $user->password = bcrypt($request->input('password'));
        $user->setRememberToken(Str::random(60));
        $user->save();

        event(new PasswordResetEvent($user));

        alert()->success('Your password was updated successfully.');

        return back();
    }

}
