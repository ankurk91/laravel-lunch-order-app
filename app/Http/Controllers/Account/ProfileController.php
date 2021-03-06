<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\ProfileUpdateRequest;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = Auth::user();
        $user->loadMissing(['profile']);

        return view('account.profile', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ProfileUpdateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileUpdateRequest $request)
    {
        UserProfile::updateOrCreate(
            ['user_id' => $request->user()->id],
            $request->only(
                ['first_name', 'last_name', 'primary_phone']
            )
        );

        alert()->success('Your profile was updated successfully.');
        return back();
    }

}
