<?php

namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Account\PasswordUpdateRequest;
use Illuminate\Auth\Events\PasswordReset as PasswordResetEvent;

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
            'user' => auth()->user()
        ]);
    }

    /**
     * Update the user password in storage.
     *
     * @param  PasswordUpdateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(PasswordUpdateRequest $request)
    {
        $request->user()->forceFill([
            'password' => bcrypt($request->input('password')),
            'remember_token' => null,
        ])->save();

        event(new PasswordResetEvent($request->user()));

        alert()->success('Your password was updated successfully.');

        return back();
    }

}
