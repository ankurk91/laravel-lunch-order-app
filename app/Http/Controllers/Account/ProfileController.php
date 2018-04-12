<?php

namespace App\Http\Controllers\Account;

use App\Http\Requests\Account\ProfileUpdateRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        return view('account.profile', [
            'user' => $user,
            'profile' => $user->profile,
            'roles' => $user->getRoleNames()->toArray()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ProfileUpdateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileUpdateRequest $request)
    {
        UserProfile::updateOrCreate(
            ['user_id' => Auth::id()],
            $request->only(
                ['first_name', 'last_name', 'primary_phone']
            )
        );

        alert()->success('Your profile was updated successfully.');
        return back();
    }

}
